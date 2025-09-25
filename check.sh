# lint, perform static analysis, and run the test suite
./vendor/bin/phpstan analyze src tests
./vendor/bin/phpcs
./vendor/bin/phpunit tests