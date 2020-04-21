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
 - Docker compose version 1.22 or later
 - An editor or IDE (PHPStorm is recommended)
 - MySQL client ([HeidiSQL](https://www.heidisql.com/) is free to use)
 
## Components
 - Apache 2.4
 - PHP >= 7.2
 - Laravel 7.4
 - [Cypress 4.3](https://www.cypress.io/) (Testing framework for acceptance tests)
 
## Installation
 1. Clone this repository from GitHub
 2. Add domain to local `hosts` file:

    ```bash
    127.0.0.1  laravel-ci-training-testing.local
    ```
 3. Build and start the application from your terminal:
    ```bash
    composer install
    npm install
    ```
    
    Note: It will take some time, so bear with me 
 4. Make sure below url works in your browser:
    
    ```bash
    laravel-ci-training-testing.local:8000 # used to load test environment for phpunit and cypress
    ```

## Packages
#### Composer Packages
| Name | Description |
| ----------- | ----------- |
| [laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) | IDE helper for Laravel autocomplete |
| [composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks) | Manage git hooks easily in your composer configuration |

#### NPM Packages
| Name | Description |
| ----------- | ----------- |
| [eslint](https://github.com/eslint/eslint) | ESLint is a tool for identifying and reporting on patterns found in ECMAScript/JavaScript code |
| [prettier](https://github.com/prettier/prettier) | Prettier is an opinionated code formatter for javascript |

#### References
