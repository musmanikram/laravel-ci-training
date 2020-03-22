.DEFAULT_GOAL := help

php-project=laravel-ci-training-app
mysql-project=laravel-ci-training-mysql
interactive:=$(shell [ -t 0 ] && echo 1)
ifneq ($(interactive),1)
	optionT=-T
endif

RED=\033[31m
CYAN=\033[36m
YELLOW=\033[33m
GREEN=\033[32m
DEFAULT=\033[0m

DOCKER := true

ifeq ($(DOCKER),true)
	START_COMMAND := docker-compose run
else
	START_COMMAND :=
endif

.PHONY: help
help:
	@echo "To start the development environment use: ${YELLOW}make start${DEFAULT}"
	@echo ''
	@echo 'To run a task: make [task_name]'
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "%s%-30s%s %s\n", "${CYAN}", $$1, "${DEFAULT}",$$2}'

.PHONY: start
start: ## Start the development environment
	@echo "Starting development environment"
	@make stop
	@scripts/start-development

.PHONY: stop
stop: ## Stop the development environment
	@echo "Stopping development environment"
	@scripts/stop-development

.PHONY: ssh
ssh: ## Login into PHP-Apache container shell
	@echo "${GREEN}Logging you in PHP-Apache container shell${DEFAULT}"
	${START_COMMAND} $(php-project) bash

.PHONY: ssh-mysql
ssh-mysql: ## Login into MySQL container shell
	@echo "${GREEN}Logging you in MySQL container shell${DEFAULT}"
	${START_COMMAND} $(mysql-project) bash

.PHONY: exec
exec: ## Exucute some command defined in cmd="..." variable inside PHP-Apache container shell
	@echo "${DEFAULT} Executing: ${CYAN} ${START_COMMAND} $(php-project) bash -c \"${cmd}\" ${DEFAULT}"
	${START_COMMAND} $(php-project) bash -c "${cmd}"

.PHONY: clear-cache
clear-cache: ## Clear laravel cache i.e php artisan cache:clear
	@echo "${CYAN} Clearing cache ${DEFAULT}"
	@make exec cmd="php artisan cache:clear"

.PHONY: clear-config
clear-config: ## Clear laravel config i.e php artisan config:clear
	@echo "${CYAN} Clearing cache ${DEFAULT}"
	@make exec cmd="php artisan config:clear"

.PHONY: clear-all
clear-all: ## Clear laravel config and cache together
	@echo "${CYAN} Clearing all ${DEFAULT}"
	@make clear-cache && make clear-config
