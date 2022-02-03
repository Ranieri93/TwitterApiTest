

# About this DUMMY APP

This is a simple demo which is using Tittwer API!

## PRE-REQUISITES

- PHP 8.1.2 (https://www.php.net/downloads.php)
- COMPOSER (https://getcomposer.org/download/)
- NODE (https://nodejs.org/it/download/)

These are mandatory to run the project

## SETTING UP PROJECT

1. Clone the repository.
2. Open terminal inside project root and: 
```
composer install
npm install
``` 
3.Make a copy of env file and create token using
```
cp .env.example .env
php artisan key:generate
``` 

## SETTING UP TWITTER DEV ACCOUNT

1. If you don't have one, you must go to https://developer.twitter.com/en/docs/developer-portal/overview and create a dev account.
2. Go to your dashboard and create a new project with a new app following the steps.
3. Once inside the newly created App you must you have to click on edit in the " User authentication settings" section (below you app details) and follow the steps to allow both OAuth 2.0 && OAuth 1.0a.
4. Then go back to your App tab and go to Keys and tokens. In here you find API key and Secret / Bearer Token / Access Token and Secret.
N.B. In order to function you need to generate The Access and Secret Token with Read and Write permissions!

5. Go in your project and open .env file and create the following variables:
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



