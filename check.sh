# lint, perform static analysis, and run the test suite
trap 'RC=1' ERR

./vendor/bin/phpstan analyze src tests
./vendor/bin/phpcs
./vendor/bin/phpunit tests

exit $RC