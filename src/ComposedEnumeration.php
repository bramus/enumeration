<?php

namespace Bramus\Enumeration;

abstract class ComposedEnumeration extends Enumeration
{
	/**
	 * List of classes that compose the "master" enumeration.
	 *
	 * @var array
	 */
	public static $classes = [];
}
