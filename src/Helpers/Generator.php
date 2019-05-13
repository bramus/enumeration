<?php

namespace Bramus\Enumeration\Helpers;

class Generator
{
	public static $namespace = '\\';

	/**
	 * This funcion maps out ::generate* calls to the proper class.
	 * Calling `::generateCapability()` for example will return a random Capability
	 * Calling `::generateCapability('CREDIT_CARD_PAYABLE')` for example will return the Capability 'CREDIT_CARD_PAYABLE'.
	 *
	 * @param [type] $method [description]
	 * @param [type] $args   [description]
	 *
	 * @return [type] [description]
	 */
	public static function __callStatic($method, $args)
	{
		// Only respond to generate* calls
		$prefix = 'generate';
		if (substr($method, 0, strlen($prefix)) == $prefix) {
			// Split off classname from the given method
			$class = static::$namespace . substr($method, strlen($prefix));

			// Make sure the classs is an enumeration
			if (!is_subclass_of($class, 'Bramus\Enumeration\Enumeration')) {
				throw new \InvalidArgumentException('Invalid class “' . $class . '”. It is not an Enumeration.');
			}

			// If a specific value is requested, return that
			if (isset($args[0])) {
				// If it already is an instance, return it immediately
				if (is_a($args[0], $class)) {
					return $args[0];
				}

				try {
					return new $class($args[0]);
				} catch (\Exception $e) {
					throw new \InvalidArgumentException('Invalid enumeration value ' . $args[0] . ' for Enumeration ' . $class);
				}
			}

			// No specific value is requested, return the default (if set) or a random one
			$values = $class::values();
			if (null !== $class::__DEFAULT) {
				return new $class();
			}

			return new $class($values[array_rand($values)]);
		}

		throw new \InvalidArgumentException('Invalid method call ::' . $method);
	}

	public static function setNamespace($namespace)
	{
		static::$namespace = $namespace;
	}
}
