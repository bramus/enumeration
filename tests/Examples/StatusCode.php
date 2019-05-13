<?php

namespace Tests\Bramus\Enumeration\Examples;

use Bramus\Enumeration\ComposedEnumeration;

class StatusCode extends ComposedEnumeration
{
	const __DEFAULT = 200;

	public static $classes = [
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\Informational',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\Success',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\Redirection',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\ClientError',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\ServerError',
	];
}
