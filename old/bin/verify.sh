#!/usr/bin/env bash
set -ex # stop on failure / debug on

vendor/bin/phpcs --standard=PSR2 src/ tests/
vendor/bin/phpunit --coverage-text
