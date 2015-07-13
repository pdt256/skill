Elo Rating
=================
[![Test Coverage](http://img.shields.io/badge/coverage-100%25-brightgreen.svg)](https://codeclimate.com/github/inklabs/kommerce-core)
[![Build Status](https://travis-ci.org/pdt256/elo.svg?branch=master)](https://travis-ci.org/pdt256/elo)
[![Downloads](https://img.shields.io/packagist/dt/pdt256/elo.svg)](https://packagist.org/packages/pdt256/elo)
[![License](https://img.shields.io/packagist/l/pdt256/elo.svg)](https://github.com/pdt256/elo/blob/master/LICENSE.txt)

## Introduction

All code (including tests) conform to the PSR-2 coding standards. The namespace and autoloader
are using the PSR-4 standard.

## Installation

Add the following lines to your ``composer.json`` file.

```JSON
{
    "require": {
        "pdt256/elo": "dev-master"
    }
}
```

```
   composer install
```

## Unit Tests:

<pre>
    vendor/bin/phpunit
</pre>

### With Code Coverage:

<pre>
    vendor/bin/phpunit --coverage-text --coverage-html coverage_report
</pre>

## Run Coding Standards Test:

<pre>
    vendor/bin/phpcs --standard=PSR2 src/ tests/
</pre>

### License

The MIT License (MIT)

Copyright (c) 2015 Jamie Isaacs <pdt256@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
