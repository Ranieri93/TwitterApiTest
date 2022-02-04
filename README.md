

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
4. Then go back to your App tab and go to Keys and tokens section. In there you find API key and Secret / Bearer Token / Access Token and Secret.
N.B. In order to make the project work you need to generate the Access and Secret Token with Read and Write permissions!

5. Go in your project, open .env file and create the following variables:
```env
TWITTER_API_KEY=//insert here
TWITTER_API_SECRET_KEY=//insert here
TWITTER_BEARER_TOKEN=//insert here
TWITTER_ACCESS_TOKEN=//insert here
TWITTER_ACCESS_SECRET_TOKEN=//insert here
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

The project is based on the well known PHP Framework Laravel (https://laravel.com/). It has been used as a starting set up, then personalizations has been added, and in this section they will be shortly explained.

## DATA TRANSFER OBJECTS (DTO)

As the name suggests these are nothing more than a carrier of informations. Their general purpose is to move datas from a place to another without losing its consistency.
They should not contain any business logic, but they may have some kind of serialization/deserialisation processes.

In this specific case one exapmle could be:
```php
class SearchByIdDto
{
    public int $tweet_ID;

    /**
     * @param int $tweet_ID
     */
    public function __construct(int $tweet_ID)
    {
        $this->tweet_ID = $tweet_ID;
    }

    /**
     * @param int $tweet_ID
     * @return static
     */
    public static function create(
        int $tweet_ID
    ): self {
        return new self(
            $tweet_ID
        );
    }
}
```
Nothing more than a class with a property initialized with a constructor and a static method with self return, that allow us to call it easily from outside.


## SERVICES

They have been used in their easiest and common practice, in the sense that the controllor wich have been in contact with some request, delegates some process to these objects.
The idea is that your business logic is separated from your dispatcher logic and that results in a leaner and understandable statement. Services usually have to be as atomic as possibile in the sense that they should execute one single task, in order to maximize their reusability and therefore code maintainability.

Here an example:

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
The class SearchService has been injected in the searchHandler controller method and, as you can see, it is only calling the service, nothing more. 

This is how the service looks up:
```php
class SearchService
{
    /**
     *
     * @param SearchDto $dto
     * @return bool|string
     */
    public function execute(
        SearchDto $dto
    ): bool|string {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/tweets/search/recent?query=' . $dto->query_string . '&tweet.fields=text,author_id,lang',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . config('laravel-twitter-streaming-api.bearer_token'),
                'Cookie: guest_id=v1%3A164389434401851648'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
```
This class is executing one single task, which is performing a curl call and returning a response object.
In this dummy application because of the poor complexity you may not see which are the upsides of this approach, but just think about scheduling a cron which performs the same action: you just need to instantiate the dto again with correct parameters and call this service.  
