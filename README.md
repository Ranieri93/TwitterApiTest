

# About this DUMMY APP

This is a simple demo which is using Tittwer API!

## PRE-REQUISITES

- PHP 8.1.2 (https://www.php.net/downloads.php)
- COMPOSER (https://getcomposer.org/download/)
- NODE (https://nodejs.org/it/download/)

These are mandatory to run the project

## SETTING UP

1. Clone the repository.
2. Open terminal inside project root and: 
```
composer install
npm install
npm run dev
``` 
3.Make a copy of env file and create token using
```
cp .env.example .env
php artisan key:generate
``` 

## SETTING UP TWITTER DEV ACCOUNT

1. If you don't have one, you must go to https://developer.twitter.com/en/docs/developer-portal/overview and follow instructions to create a new account.
2. Go to your dashboard and create a new project with a new app following the steps.
3. Once inside the newly created App, click on edit in the "User authentication settings" section (below your app details) and follow the steps to allow both OAuth 2.0 && OAuth 1.0a.
![user auth section](https://github.com/Ranieri93/TwitterApiTest/blob/master/storage/readme_imgs/user_auth_settings.jpg?raw=true)

4. Activate user OAuth 2.0 && OAuth 1.0a as shown above (add also GENERAL AUTHENTICATION SETTINGS)
![user auth section](https://github.com/Ranieri93/TwitterApiTest/blob/master/storage/readme_imgs/user_auth_ok.jpg?raw=true)

6. Then go back to your App tab and go to Keys and tokens section. In there you find API key and Secret / Bearer Token / Access Token and Secret.<br/>
**N.B. In order to make the project work you need to generate the Access and Secret Token with Read and Write permissions!**
![user auth section](https://github.com/Ranieri93/TwitterApiTest/blob/master/storage/readme_imgs/user_keys.jpg?raw=true)

5. Go in your project, open .env file and create the following variables:
```env
TWITTER_CONSUMER_KEY=//insert here
TWITTER_CONSUMER_SECRET=//insert here
TWITTER_BEARER_TOKEN=//insert here
TWITTER_ACCESS_TOKEN=//insert here
TWITTER_ACCESS_TOKEN_SECRET=//insert here
TWITTER_API_VERSION=2
``` 

## LAUNCH APP
Inside project root:
```
php artisan serve
``` 
A local server should be provided out of the box. Visit the link and enjoy!


# APPROACH

Here will be explained best practices used in writing this small application

## GENERAL INFOS

The project is based on the well known PHP Framework Laravel (https://laravel.com/).<br> It has been used as a starting set up, then personalizations has been added, and in this section they will be shortly explained.

## DATA TRANSFER OBJECTS (DTO)

As the name suggests, these are basically carriers of informations. Their general purpose is to move data from a place to another without losing its consistency.<br/>
They should not contain any business logic, but they may execute some kind of serialization/deserialisation processes or validations of any kind.

In this specific case one exapmle could be:
```php
class SearchDto
{
    public string $query_string;

    /**
     * @param string $query_string
     */
    public function __construct(string $query_string)
    {
        $this->query_string = $query_string;
    }

    /**
     * @param string $query_string
     * @return SearchDto
     */
    public static function create(
        string $query_string
    ): self {
        return new self(
            $query_string
        );
    }
}
```
Nothing more than a class with a property initialized in the constructor and a static method with self return, that allow us to call it easily from outside.

## FROM REQUESTS
Form requests are nothing new in Laravel ecosystem (https://laravel.com/docs/8.x/validation#form-request-validation).<br/> Their usage is basically allowing you to encapsulate validation logic coming from a request. The major upside is that they provide an easier and understandable validation (because it is localized in one place), and ultimately lift up all the work that otherwise you should do in the controller, making it leaner and lighter.<br/>
Now that we have a class dedicated to validation, it is the perfect place to instanciate there our DTO.<br/>
Here's an example:
```php
class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'query_string' => 'required|string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'query_string.string' => 'The input must be a string!',
        ];
    }

    /**
     * @return SearchDto
     */
    public function getDto(): SearchDto
    {
        return SearchDto::create(
            (string)$this->get('query_string')
        );
    }
}
```
It has been created a method getDto() (it will be common in every form request) that instanciate our DTO calling its static create method.<br>
We have created a second layer of validation, the first one it's performed automatically by the Laravel's request rules, and the second one by our DTO.


## SERVICES

They have been used in their easiest and common practice, in the sense that the controller which have been in contact with some request, delegates some process to these objects.
The idea is that your business logic is separated from your dispatcher logic and that results in a leaner and understandable statement. Services usually have to be as atomic as possibile they should in fact execute one single task, in order to maximize their reusability and therefore code maintainability.
<br>
Here's a controller method which is being injected with a form request and the service itself. As the name suggests the controller has only to handle and organize, it calls service's execute method providing it the requested DTO

```php
class TwitterApiController extends BaseController
{
    public function searchHandler(
        SearchRequest $request,
        SearchService $searchService
    ) {
        return $searchService->execute($request->getDto());
    }
}
```
<br>
This is how the service looks up:

```php
class SearchService
{
    /**
     * Uses vanilla php curl handler to perform a post request and search for daily posts with a keyword
     * @param SearchDto $dto
     * @return bool|string
     */
    public function execute(
        SearchDto $dto
    ): bool|string {
        $today = Carbon::today()->toImmutable()->format('Y-m-d');
        $now = Carbon::now()->toImmutable()->subMinute()->format('H:i:s');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/tweets/search/recent?query=' . $dto->query_string . '&tweet.fields=created_at,text,author_id,lang&end_time=' . $today . 'T' . $now . '.000Z&start_time=' . $today . 'T00:00:10.000Z',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer token',
                'Cookie: guest_id'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
```
This method is exepting our DTO as parameter, so we don't need to worry about input's correctness, and executing one single task, which is performing a curl call and returning a response.
<br>
In this dummy application, because of the poor complexity, you may not fully understand the upsides of this approach, but for example think about scheduling a cron which performs the same action: you just need to instantiate the dto again with correct parameters, call this service and you are done!
