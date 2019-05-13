# `bramus/enumeration`

[![Build Status](https://img.shields.io/travis/bramus/enumeration.svg?style=flat-square)](http://travis-ci.org/bramus/enumeration) [![Source](http://img.shields.io/badge/source-bramus/enumeration-blue.svg?style=flat-square)](https://github.com/bramus/enumeration) [![Version](https://img.shields.io/packagist/v/bramus/enumeration.svg?style=flat-square)](https://packagist.org/packages/bramus/enumeration) [![Downloads](https://img.shields.io/packagist/dt/bramus/enumeration.svg?style=flat-square)](https://packagist.org/packages/bramus/enumeration/stats) [![License](https://img.shields.io/packagist/l/bramus/enumeration.svg?style=flat-square)](https://github.com/bramus/enumeration/blob/master/LICENSE)

`bramus/enumeration` is an Enumeration Implementation for PHP. It allows one to create both [singular enumerations](#singular-enumerations) and [composed enumerations](#composed-enumerations).

Built by Bram(us) Van Damme _([https://www.bram.us](https://www.bram.us))_ and [Contributors](https://github.com/bramus/enumeration/graphs/contributors)

## Prerequisites/Requirements

- PHP 7.2 or greater

## Installation

Installation is possible using Composer

```
$ composer require bramus/enumeration ~1.2
```

## Usage

### Singular Enumerations

```php
<?php

use Bramus\Enumeration\Enumeration;

class Weekday extends Enumeration
{
	const MONDAY = 1;
	const TUESDAY = 2;
	const WEDNESDAY = 3;
	const THURSDAY = 4;
	const FRIDAY = 5;
	const SATURDAY = 6;
	const SUNDAY = 7;
}
```

#### Creating and Playing with Instances

```php
$instance = new Weekday(1);
$instance = new Weekday(Weekday::MONDAY);
$instance = Weekday::MONDAY();
```

```php
$instance->getValue();
// ~> 1

$instance->getIdentifier();
// ~> 'MONDAY'

(string) $instance;
// ~> '1'
```

#### Converting between values and identifiers

```php
Weekday::toValue('MONDAY');
// ~> 1

Weekday::toIdentifier(1);
// ~> 'MONDAY;
```

#### Listing values and identifiers

```php
Weekday::values();
// ~> [1, 2, 3, 4, 5, 6, 7]

Weekday::identifiers();
// ~> ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY']
```

#### Checking values and identifiers

```php
Weekday::isValidValue(2);
// ~> true

Weekday::isValidValue(8);
// ~> false

Weekday::isValidIdentifier('TUESDAY');
// ~> true

Weekday::isValidIdentifier('SUMMERDAY');
// ~> false
```

### Composed Enumerations

It's also possible to have one Enumeration be composed of several other enumerations

```php
<?php

namespace Bramus\Http\StatusCodes;

use Bramus\Enumeration\Enumeration;
use Bramus\Enumeration\ComposedEnumeration;

abstract class Informal extends Enumeration
{
	const CONTINUE = 100;
	const SWITCHING_PROTOCOLS = 101;
	const PROCESSING = 102;
	…
}

abstract class Success extends Enumeration
{
	const OK = 200;
	const CREATED = 201;
	const ACCEPTED = 202;
	…
}

abstract class Redirection extends Enumeration
{
	const MULTIPLE_CHOICES = 300;
	const MOVED_PERMANENTLY = 301;
	const FOUND = 302;
	…
}

abstract class ClientError extends Enumeration
{
	const BAD_REQUEST = 400;
	const UNAUTHORIZED = 401;
	const PAYMENT_REQUIRED = 402;
	…
	const IM_A_TEAPOT = 418;
	…
}

abstract class ServerError extends Enumeration
{
	const INTERNAL_SERVER_ERROR = 500;
	const NOT_IMPLEMENTED = 501;
	const BAD_GATEWAY = 502;
	…
	const NETWORK_AUTHENTICATION_REQUIRED = 511;
}

class StatusCode extends ComposedEnumeration
{
	public static $classes = [
		'\Bramus\Http\StatusCodes\Informal',
		'\Bramus\Http\StatusCodes\Success',
		'\Bramus\Http\StatusCodes\Redirection',
		'\Bramus\Http\StatusCodes\ClientError',
		'\Bramus\Http\StatusCodes\ServerError',
	];
}
```

@note: Whilst it is technically possible to re-use the same identifiers and values throughout the classes that make up the composed Enumeration, it is discouraged to do so.

#### Creating and Playing with Instances

```php
use Bramus\Http\StatusCodes\StatusCode;

$instance = new StatusCode(200);
// $instance = new StatusCode(StatusCode::OK); <-- This won't work, due to __getStatic not existing in PHP …
$instance = StatusCode::OK();
```

```php
$instance->getValue();
// ~> 200

$instance->getIdentifier();
// ~> 'OK'

(string) $instance;
// ~> '200'
```

#### Converting between values and identifiers

```php
StatusCode::toValue('OK');
// ~> 200

StatusCode::toIdentifier(200);
// ~> 'OK;
```

#### Listing values and identifiers

```php
StatusCode::values();
// ~> [100, 101, 102, …, 200, 201, 202, …, 511]

StatusCode::identifiers();
// ~> ['CONTINUE', 'SWITCHING_PROTOCOLS', 'PROCESSING', …, 'OK', 'CREATED', 'ACCEPTED', …, 'NETWORK_AUTHENTICATION_REQUIRED']
```

#### Checking values and identifiers

```php
StatusCode::isValidValue(418);
// ~> true

StatusCode::isValidValue(700);
// ~> false

StatusCode::isValidIdentifier('IM_A_TEAPOT');
// ~> true

StatusCode::isValidIdentifier('BROKEN');
// ~> false
```

### Default Values

If you want, you can define a default value to use. Define it as a constant named `__DEFAULT` on your class and you're good to go:

```php
<?php

use Bramus\Enumeration\Enumeration;

class Weekday extends Enumeration
{
	const __DEFAULT = 1;

	const MONDAY = 1;
	const TUESDAY = 2;
	…
}
```

The default will be used when no value is passed into the constructor:

```php
$instance = new Weekday();

// object(Weekday)#424 (2) {
//  ["value":"Bramus\Enumeration\Enumeration":private]=>
//  int(1)
//  ["identifier":"Bramus\Enumeration\Enumeration":private]=>
//  string(6) "MONDAY"
//}
```

This works both for both the `Enumeration` and `ComposedEnumeration` classes:

```php
class StatusCode extends ComposedEnumeration
{
	const __DEFAULT = 200;

	public static $classes = [
		…
	];
}
```

### Summaries and Descriptions

When defining [DocBlocks](https://docs.phpdoc.org/references/phpdoc/basic-syntax.html) to go with your enumeration constants, you can get its summary and description using the `getSummary()` and `getDescription()` methods respectively.

```php
<?php

use Bramus\Enumeration\Enumeration;

class Weekday extends Enumeration
{
	/**
	 * Monday.
	 *
	 * The first day of the week.
	 */
	const MONDAY = 1;

	//
}
```

```php
$instance = new Weekday(1);

$instance->getSummary();
// ~> 'Monday.'

$instance->getDescription();
// ~> 'The first day of the week.'
```

Static methods to fetching these are also available. For each their only argument is a valid Enumeration value or a `Bramus\Enumeration\Enumeration` instance:

```php
Weekday::toSummary(Weekday::MONDAY);
// ~> 'Monday.'

Weekday::toSummary($instance);
// ~> 'Monday.'

Weekday::toDescription(Weekday::MONDAY);
// ~> 'The first day of the week.'

Weekday::toDescription($instance);
// ~> 'The first day of the week.'
```


## Utility Classes

`bramus/enumeration` comes with 2 utility classes. Whilst you most likely don't need to use these directly, they might be of help:

### `\Bramus\Enumeration\Helpers\Extractor`

This class extracts constants/identifiers/values from `\Bramus\Enumeration\Enumeration` classes. It is used by `\Bramus\Enumeration\Enumeration` internally.

### `\Bramus\Enumeration\Helpers\Generator`

This class allows one to generate instances of `\Bramus\Enumeration\Enumeration` classes. Given the example `\Bramus\Http\StatusCodes\StatusCode` class from above, its usage might be something like this:

```php
use Bramus\Enumeration\Helpers\Generator;

Generator::setNamespace('\\Bramus\\Http\\StatusCodes\\');

Generator::generateStatusCode(); // Generates a \Bramus\Http\StatusCodes\StatusCode instance with its default value
Generator::generateStatusCode(404); // Generates a \Bramus\Http\StatusCodes\StatusCode instance with the value 404
```

@note: In case the `Enumeration` has no `__DEFAULT` _(e.g. it is `NULL`)_, calling `Generator::generate*` will return a random value for the Enumeration.

## Testing

`bramus/enumeration` ships with unit tests using [PHPUnit](https://github.com/sebastianbergmann/phpunit/) `~8.0`.

- If PHPUnit is installed globally run `phpunit` to run the tests.
- If PHPUnit is not installed globally, install it locally throuh composer by running `composer install --dev`. Run the tests themselves by calling `./vendor/bin/phpunit` or using the composer script `composer test`

```
$ composer test
```

## License

`bramus/enumeration` is released under the MIT public license. See the enclosed `LICENSE` for details.