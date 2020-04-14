<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


## About this Repo

This sample Laravel application developed to give you an idea how you can improve your coding. This application will try cover following points:

 - [x] [Dockers setup]
 - [x] [Use of Makefile]
 - [x] [PHP CodeSniffer]
 - [x] [Unit Testing]
 - [x] [Acceptance Tests]
 - [x] [Packages]

## Requirements
 - Docker version 18.06 or later
 - Docker compose version 1.22 or later
 - An editor or IDE (PHPStorm is recommended)
 - MySQL client ([HeidiSQL](https://www.heidisql.com/) is free to use)
 
## Components
 - Apache 2.4
 - PHP 7.4 (Apache handler)
 - MySQL 8
 - Laravel 7.4
 - [Cypress 4.3](https://www.cypress.io/) (Testing framework for acceptance tests)
 
## Installation
 1. Clone this repository from GitHub
 2. Add domain to local `hosts` file:

    ```bash
    127.0.0.1  laravel-ci-training.local
    ```
 3. Build and start the application from your terminal:
    ```bash
    make start
    ```
    
    Note: It will take some time, so bear with me 
 4. Make sure these two urls works in your browser:
    
    i. 
    ```bash
    http://localhost:8000
    ```
    ii. 
    ```bash
    http://localhost:8000 # used to load test environment for phpunit and cypress
    ```

## Additional commands
Run `make` in root directory of project. You will similar list below with description of each command:

```bash
To start the development environment use: make start

To run a task: make [task_name]
clear-all                      Clear laravel config and cache together
clear-cache                    Clear laravel cache i.e php artisan cache:clear
clear-config                   Clear laravel config i.e php artisan config:clear
exec                           Exucute some command defined in cmd="..." variable inside PHP-Apache container shell
phpcs-fix                      Run CodeSniffer fixer to fix php errors
phpcs                          Run CodeSniffer to show php errors
ssh-mysql                      Login into MySQL container shell
ssh                            Login into PHP-Apache container shell
start                          Start the development environment
stop                           Stop the development environment
```

## Packages
#### Composer Packages
| Name | Description |
| ----------- | ----------- |
| [laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) | IDE helper for Laravel autocomplete |
| [composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks) | Manage git hooks easily in your composer configuration |
| [composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks) | Manage git hooks easily in your composer configuration |

#### NPM Packages
| Name | Description |
| ----------- | ----------- |
| [eslint](https://github.com/eslint/eslint) | ESLint is a tool for identifying and reporting on patterns found in ECMAScript/JavaScript code |
| [prettier](https://github.com/prettier/prettier) | Prettier is an opinionated code formatter for javascript |

#### References
