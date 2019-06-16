
##
## Docker :
## --------
##
.PHONY: install start stop connect


install: # install the project
	docker-compose up -d
	docker-compose exec php bash -c "composer install"

start: # start the container
	docker-compose up -d

stop: # stop the container
	docker-compose down --remove-orphans

connect: # enter the container
	docker-compose exec php bash





.PHONY: help
help:
	@grep -E '(^[a-zA-Z0-9_\-\.]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/
