.PHONY: help dce dcu dcb composer-install

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

dce: dcu  ## Get into container (after build & up it)
	docker-compose run php bash

dcu: dcb ## Up container (after build)
	docker-compose up -d

dcb: ## Build image (cfr Dockerfile)
	docker-compose build

composer.phar: ## Retrieve current (2022-11-29) composer.phar
	docker-compose run php sh -c "curl https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer | php -- --quiet"

composer-install: composer.phar ## Composer install
	docker-compose run php php composer.phar install