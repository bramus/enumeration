<?php

namespace Tests\Bramus\Enumeration\Examples;

use Bramus\Enumeration\ComposedEnumeration;

class StatusCode extends ComposedEnumeration
{
	public static $classes = [
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\Informal',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\Success',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\Redirection',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\ClientError',
		'\Tests\Bramus\Enumeration\Examples\StatusCodes\ServerError',
	];
}
