<?php

namespace Bramus\Enumeration;

use Bramus\Enumeration\Helpers\Extractor;

abstract class Enumeration
{
	const __DEFAULT = null;

	public static $descriptions = [];

	private $value;
	private $identifier;
	private $summary;
	private $description;

	/**
	 * Creates a new instance and validates the given value along with that.
	 *
	 * @param string $value
	 */
	final public function __construct($value = null)
	{
		$class = get_called_class();

		// No value given? Inject __DEFAULT
		if (null === $value) {
			$value = $class::__DEFAULT;
		}

		if (!$class::isValidValue($value)) {
			throw new \InvalidArgumentException($value . ' is a not a valid value for the ' . $class . ' Enumeration. Allowed identifiers are ' . implode(', ', $class::identifiers()));
		}

		$this->value = $value;
		$this->identifier = $class::toIdentifier($this->value);
		$this->summary = $class::toSummary($this->value);
		$this->description = $class::toDescription($this->value);
	}

	/**
	 * Returns the value.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->value;
	}

	/**
	 * Enables on to perform things like Enumeration::IDENTIFIER().
	 *
	 * @param string $identifier
	 * @param array  $args
	 *
	 * @return mixed
	 */
	public static function __callStatic($identifier, $args)
	{
		$class = get_called_class();

		// Make sure we have an Enumeration
		if (!is_subclass_of($class, self::class)) {
			throw new \InvalidArgumentException('Invalid Class ' . $class . ': It is not an Enumeration.');
		}

		$value = $class::toValue($identifier);

		return new $class($value);
	}

	/**
	 * Returns the identifier.
	 *
	 * @return mixed
	 */
	public function getIdentifier()
	{
		return $this->identifier;
	}

	/**
	 * Returns the value.
	 *
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Returns the summary.
	 *
	 * @return mixed
	 */
	public function getSummary()
	{
		return $this->summary;
	}

	/**
	 * Returns the description.
	 *
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

	public function equals($value)
	{
		// It's an Enumeration? Call getValue()
		if (is_a($value, self::class)) {
			$value = $value->getValue();
		}

		// Compare 'm
		return $this->getValue() === $value;
	}

	/**
	 * Lists all identifiers for this Enumeration.
	 *
	 * @param bool $excludeDefault
	 *
	 * @return array
	 */
	public static function identifiers($excludeDefault = true)
	{
		return Extractor::extractIdentifiers(get_called_class(), $excludeDefault);
	}

	/**
	 * Checks whether an identifier is valid.
	 *
	 * @param string $identifier
	 *
	 * @return bool
	 */
	final public static function isValidIdentifier($identifier)
	{
		return in_array($identifier, static::identifiers());
	}

	/**
	 * Lists all values for this Enumeration.
	 *
	 * @param bool $excludeDefault
	 *
	 * @return array
	 */
	public static function values($excludeDefault = true)
	{
		return Extractor::extractValues(get_called_class(), $excludeDefault);
	}

	/**
	 * Checks whether a value is valid.
	 *
	 * @param string $value
	 *
	 * @return bool
	 */
	final public static function isValidValue($value)
	{
		return in_array($value, static::values());
	}

	/**
	 * Gets the identifier for a value.
	 *
	 * @param mixed $value
	 *
	 * @return string
	 */
	final public static function toIdentifier($value)
	{
		// It's an Enumeration? Call getIdentifier()
		if (is_a($value, self::class)) {
			return $value->getIdentifier();
		}

		// Extract all constants
		$constants = Extractor::extractConstants(static::class);

		// Make sure the value exists
		if (!array_key_exists($value, array_flip($constants))) {
			throw new \InvalidArgumentException('Invalid Enumeration value ' . $value . ' on class ' . get_called_class());
		}

		// Return it
		return array_flip($constants)[$value];
	}

	/**
	 * Gets the value for an identifier.
	 *
	 * @param string $identifier
	 *
	 * @return mixed
	 */
	final public static function toValue($identifier)
	{
		// It's an Enumeration? Call getValue()
		if (is_a($identifier, self::class)) {
			return $identifier->getValue();
		}

		// Extract all constants
		$constants = Extractor::extractConstants(static::class);

		// Make sure the identifier exists
		if (!array_key_exists($identifier, $constants)) {
			throw new \InvalidArgumentException('Invalid Enumeration identifier ' . $identifier . ' on class ' . get_called_class());
		}

		// Return it
		return $constants[$identifier];
	}

	/**
	 * Lists all summaries for this Enumeration.
	 *
	 * @param bool $excludeDefault
	 *
	 * @return array
	 */
	public static function summaries($excludeDefault = true)
	{
		return array_combine(
			Extractor::extractValues(get_called_class(), $excludeDefault),
			Extractor::extractSummaries(get_called_class(), $excludeDefault)
		);
	}

	/**
	 * Gets the summary for an identifier.
	 *
	 * @param string $identifier
	 * @param mixed  $value
	 *
	 * @return mixed
	 */
	final public static function toSummary($value)
	{
		// It's an Enumeration? Call getSummary()
		if (is_a($value, self::class)) {
			return $value->getSummary();
		}

		// Convert $value to $identifier
		$identifier = self::toIdentifier($value);

		// Extract all summaries
		$summaries = Extractor::extractSummaries(static::class);

		// Return it
		return $summaries[$identifier];
	}

	/**
	 * Lists all descriptions for this Enumeration.
	 *
	 * @param bool $excludeDefault
	 *
	 * @return array
	 */
	public static function descriptions($excludeDefault = true)
	{
		return array_combine(
			Extractor::extractValues(get_called_class(), $excludeDefault),
			Extractor::extractDescriptions(get_called_class(), $excludeDefault)
		);
	}

	/**
	 * Gets the description for an identifier.
	 *
	 * @param string $identifier
	 * @param mixed  $value
	 *
	 * @return mixed
	 */
	final public static function toDescription($value)
	{
		// It's an Enumeration? Call getDescription()
		if (is_a($value, self::class)) {
			return $value->getDescription();
		}

		// Convert $value to $identifier
		$identifier = self::toIdentifier($value);

		// Extract all descriptions
		$descriptions = Extractor::extractDescriptions(static::class);

		// Return it
		return $descriptions[$identifier];
	}
}
