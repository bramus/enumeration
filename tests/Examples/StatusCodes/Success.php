<?php

namespace Tests\Bramus\Enumeration\Examples\StatusCodes;

use Bramus\Enumeration\Enumeration;

abstract class Success extends Enumeration
{
	const OK = 200;
	const CREATED = 201;
	const ACCEPTED = 202;
	// …
}
