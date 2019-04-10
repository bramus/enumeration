<?php

namespace Tests\Bramus\Enumeration\Examples\StatusCodes;

use Bramus\Enumeration\Enumeration;

abstract class Informal extends Enumeration
{
	const CONTINUE = 100;
	const SWITCHING_PROTOCOLS = 101;
	const PROCESSING = 102;
	// …
}
