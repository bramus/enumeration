<?php

namespace Bramus\Enumeration\Helpers;

class Extractor
{
	public static $cache = [];

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
		// Result is cached
		if (isset(self::$cache[$class])) {
			$constants = self::$cache[$class];
		}

		// Result is not cached
		else {
			// Make sure we have an Enumeration
			if (!is_subclass_of($class, 'Bramus\Enumeration\Enumeration')) {
				throw new \InvalidArgumentException('Invalid Class ' . $class . ': It is not an Enumeration.');
			}

			// Set it up
			$reflectionClass = new \ReflectionClass($class);
			$classConstants = $reflectionClass->getConstants();
			$constants = [];

			// Composed Enumeration? Also include all constants from composed classes
			if ($reflectionClass->isSubclassOf('Bramus\Enumeration\ComposedEnumeration')) {
				foreach ($class::$classes as $subClass) {
					$constants += self::extractConstants($subClass, $excludeDefault);
				}
			}

			// Include class constants
			$constants += $classConstants;

			// Cache it
			self::$cache[$class] = $constants;
		}

		// Exclude default when requested
		if ($excludeDefault) {
			unset($constants['__DEFAULT']);
		}

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
