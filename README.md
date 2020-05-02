<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## About this Repo
This sample Laravel application developed to give you an idea how you can improve your coding. This application will try cover following points:

 - [x] [PHP CodeSniffer]
 - [x] [Unit Testing]
 - [x] [Acceptance Tests]
 - [x] [Packages]

## Requirements
 - PHP
 - Apache
 - MySQL 8 (recommended) / MariaDB
 - An editor or IDE (PHPStorm is recommended)
 - MySQL client ([HeidiSQL](https://www.heidisql.com/) is free to use)
 
## Components
 - Apache 2.4
 - PHP >= 7.2
 - Laravel 7.4
 - [Cypress 4.3](https://www.cypress.io/) (Testing framework for acceptance tests)
 
## Installation
 1. Clone this repository from GitHub and go to cloned directory
 2. Add domain to local `hosts` file:
    ```bash
    127.0.0.1  laravel-ci-training-testing.local
    ```
    
 3. Build and start the application from your terminal:
    ```bash
    composer install
    npm install
    ```
    > Note: It will take some time, so bear with me
 
 4. Create databases bt running following command:
     ```bash
     make:databases
     ```
    >NOTE: This will create two databases `laravel-ci-training` and `laravel-ci-training-testing` if they doesn't exist.
    Before running any cypress or phpunit test, we normally clean whole database.
    That's why we are creating `laravel-ci-training-testing` database so we don't lose all your data from actual database i.e `laravel-ci-training` while development
    
    >You can find this command above command in `app/Console/Commands/DatabaseCreateCommand.php`
    
 5. Run built in server
    ```bash
    php artisan serve
    ```  
 
 6. Make sure below url works in your browser:
    ```bash
    laravel-ci-training-testing.local:8000
    ```
    >used to load test environment for phpunit and cypress

## Cypress
**NOTE: To run cypress make sure you follow all steps of installation**

Cypress can be opened by running nay of following commands under root directory of project:

  1.  `./node_modules/.bin/cypress open`
  2.  `php artisan run:cypress` (created this to give an idea of laravel commands)

## Debugging
For debugging two famous packages [Telescope](https://laravel.com/docs/7.x/telescope#introduction) and [laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
are also added.

#### Telescope
To run Telescope make sure you have `APP_ENV=local` in your .env file.
> NOTE: You might have to stop restart your application. To do that stop existing laravel internal server and run `php artisan serve` again.
> You can read more details [here](https://laravel.com/docs/7.x/telescope#configuration)

#### Laravel Debugbar
No additional configuration is required. Will be available by default on local and development environment 

## Packages
#### Composer Packages
| Name | Description |
| ----------- | ----------- |
| [laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) | IDE helper for Laravel autocomplete |
| [composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks) | Manage git hooks easily in your composer configuration |
| [laravel/telescope](https://github.com/laravel/telescope) | Debug assistant for the Laravel framework |
| [laravel-debugbar](https://github.com/barryvdh/laravel-debugbara) | Debugbar for the Laravel framework |

#### NPM Packages
| Name | Description |
| ----------- | ----------- |
| [eslint](https://github.com/eslint/eslint) | ESLint is a tool for identifying and reporting on patterns found in ECMAScript/JavaScript code |
| [prettier](https://github.com/prettier/prettier) | Prettier is an opinionated code formatter for javascript |

#### References
