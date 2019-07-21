# Variables

ifeq ($(shell uname),Darwin)
	OS = mac
else
	OS = linux
endif
DOCKER_UP := docker.up.$(OS)
DOCKER_DOWN := docker.down.$(OS)
INSTALL := install.$(OS)

# Help

.PHONY: help
help:
	@grep -E '(^[a-zA-Z0-9_\-\.]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

# Hidden tasks

install.common:
	docker-compose up -d
	docker-compose exec php bash -c "composer install"

docker.up.linux:
	docker-compose up --build -d

docker.down.linux:
	docker-compose down --remove-orphans

docker.up.mac:
	docker-sync start
	docker-compose -f docker-compose.yml -f docker-compose.mac.yml up -d

docker.down.mac:
	docker-sync stop
	docker-compose down --remove-orphans

install.mac: install.common docker.down.linux docker.up.mac
install.linux: install.common

##
## Docker :
## --------
##

.PHONY: install start stop connect

install: $(INSTALL) ## install the project

start: $(DOCKER_UP) ## start the container

stop: $(DOCKER_DOWN) ## stop the container

connect: ## enter the container
	docker-compose exec php bash
