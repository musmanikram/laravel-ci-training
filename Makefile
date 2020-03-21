.DEFAULT_GOAL := help

project=laravel-ci-training-app
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
	START_COMMAND := docker-compose run $(project)
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
	@echo 'Starting development environment'
	@make stop
	@scripts/start-development $(project)

.PHONY: stop
stop: ## Stop the development environment
	@echo 'Stopping development environment'
	@scripts/stop-development
