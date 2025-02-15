composer-install:
	@docker compose run php composer install

composer-update:
	@docker compose run php composer update

composer-dump-autoload:
	@docker compose run php composer dump-autoload

stan:
	@docker compose run php php vendor/bin/phpstan

.PHONY: tests
tests:
	@docker compose run -e XDEBUG_MODE=coverage php php vendor/bin/phpunit -c tests/phpunit/phpunit.xml