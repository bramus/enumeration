<?php

namespace Tests\Bramus\Enumeration;

use PHPUnit\Framework\TestCase;
use Tests\Bramus\Enumeration\Examples\TrafficLight;
use Tests\Bramus\Enumeration\Examples\Weekday;

/**
 * @internal
 * @coversDefaultClass \Bramus\Enumeration\Enumeration
 */
class EnumerationTest extends TestCase
{
	public function testConstant()
	{
		$this->assertEquals(1, Weekday::MONDAY);
		$this->assertEquals(7, Weekday::SUNDAY);
	}

	public function testConstructor()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertInstanceOf(Weekday::class, $instance);
	}

	public function testCallStatic()
	{
		$instance = Weekday::MONDAY();
		$this->assertInstanceOf(Weekday::class, $instance);
	}

	public function testGetters()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals('MONDAY', $instance->getIdentifier());
		$this->assertEquals(1, $instance->getValue());
	}

	public function testToString()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals(1, (string) $instance);
	}

	public function testDefaultValue()
	{
		$instance = new Weekday();
		$this->assertInstanceOf(Weekday::class, $instance);
		$this->assertEquals(1, (string) $instance);
	}

	public function testIdentifiers()
	{
		$identifiers = Weekday::identifiers();

		$this->assertIsArray($identifiers);
		$this->assertCount(7, $identifiers);

		$this->assertContains('MONDAY', $identifiers);
		$this->assertContains('SUNDAY', $identifiers);
	}

	public function testIsValidIdentifier()
	{
		$this->assertTrue(Weekday::isValidIdentifier('MONDAY'));
		$this->assertFalse(Weekday::isValidIdentifier('SUMMERDAY'));
	}

	public function testValues()
	{
		$values = Weekday::values();

		$this->assertIsArray($values);
		$this->assertCount(7, $values);

		$this->assertContains(1, $values);
		$this->assertContains(7, $values);
	}

	public function testIsValidValue()
	{
		$this->assertTrue(Weekday::isValidValue(1));
		$this->assertFalse(Weekday::isValidValue(8));
	}

	public function testToIdentifier()
	{
		$this->assertEquals('MONDAY', Weekday::toIdentifier(1));
	}

	public function testToIdentifierWithInstance()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals('MONDAY', Weekday::toIdentifier($instance));
	}

	public function testToValue()
	{
		$this->assertEquals(1, Weekday::toValue('MONDAY'));
	}

	public function testToValueWithInstance()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals(1, Weekday::toValue($instance));
	}

	public function testGetSummary()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals('Monday.', $instance->getSummary());
	}

	public function testToSummary()
	{
		$this->assertEquals('Monday.', Weekday::toSummary(Weekday::MONDAY));
	}

	public function testToSummaryWithInstance()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals('Monday.', Weekday::toSummary($instance));
	}

	public function testToSummaryForDefault()
	{
		$this->assertEquals('Monday.', Weekday::toSummary(new Weekday()));
	}

	public function testSummaries()
	{
		$summaries = Weekday::summaries();

		$this->assertIsArray($summaries);
		$this->assertCount(7, $summaries);

		$this->assertContains(Weekday::toSummary(Weekday::MONDAY), $summaries);
		$this->assertEquals(Weekday::toSummary(Weekday::MONDAY), $summaries[Weekday::MONDAY]);
	}

	public function testToSummaryForEnumerationWithNoComments()
	{
		$this->assertEquals('', TrafficLight::toSummary(TrafficLight::RED));
	}

	public function testGetDescription()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals('The first day of the week', $instance->getDescription());
	}

	public function testToDescription()
	{
		$this->assertEquals('The first day of the week', Weekday::toDescription(Weekday::MONDAY));
	}

	public function testToDescriptionWithInstance()
	{
		$instance = new Weekday(Weekday::MONDAY);
		$this->assertEquals('The first day of the week', Weekday::toDescription($instance));
	}

	public function testToDescriptionForDefault()
	{
		$this->assertEquals('The first day of the week', Weekday::toDescription(new Weekday()));
	}

	public function testDescriptions()
	{
		$descriptions = Weekday::descriptions();

		$this->assertIsArray($descriptions);
		$this->assertCount(7, $descriptions);

		$this->assertContains(Weekday::toDescription(Weekday::MONDAY), $descriptions);
		$this->assertEquals(Weekday::toDescription(Weekday::MONDAY), $descriptions[Weekday::MONDAY]);
	}

	public function testToDescriptionForEnumerationWithNoComments()
	{
		$this->assertEquals('', TrafficLight::toDescription(TrafficLight::RED));
	}
}
