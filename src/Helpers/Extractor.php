<?php

namespace Bramus\Enumeration\Helpers;

class Extractor
{
	/**
	 * Extracts all constants from a given Enumeration.
	 *
	 * @param string $class
	 * @param bool   $excludeDefault
	 *
	 * @return array
	 */
	final public static function extractConstants($class, $excludeDefault = true)
	{
		// Make sure we have an Enumeration
		if (!is_subclass_of($class, 'Bramus\Enumeration\Enumeration')) {
			throw new \InvalidArgumentException('Invalid Class ' . $class . ': It is not an Enumeration.');
		}

		// Set it up
		$reflectionClass = new \ReflectionClass($class);
		$classConstants = (new \ReflectionClass($class))->getConstants();
		$constants = [];

		// Composed Enumeration? Also include all constants from composed classes
		if ($reflectionClass->isSubclassOf('Bramus\Enumeration\ComposedEnumeration')) {
			foreach ($class::$classes as $class) {
				$constants += self::extractConstants($class, $excludeDefault);
			}
		}

		// Exclude default if requested
		if ($excludeDefault) {
			unset($classConstants['__DEFAULT']);
		}

		// Include class constants
		$constants += $classConstants;

		return $constants;
	}

	/**
	 * Extracts all identifiers from a given Enumeration.
	 *
	 * @param string $class
	 * @param bool   $excludeDefault
	 *
	 * @return array
	 */
	final public static function extractIdentifiers($class, $excludeDefault = true)
	{
		$constants = self::extractConstants($class, $excludeDefault);

		return array_keys($constants);
	}

	/**
	 * Extracts all values from a given Enumeration.
	 *
	 * @param string $class
	 * @param bool   $excludeDefault
	 *
	 * @return array
	 */
	final public static function extractValues($class, $excludeDefault = true)
	{
		$constants = self::extractConstants($class, $excludeDefault);

		return array_values($constants);
	}
}
