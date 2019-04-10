<?php

namespace Tests\Bramus\Enumeration;

use PHPUnit\Framework\TestCase;
use Tests\Bramus\Enumeration\Examples\StatusCode;

/**
 * @internal
 * @coversDefaultClass \Bramus\Enumeration\ComposedEnumeration
 */
class ComposedEnumerationTest extends TestCase
{
	/**
	 * Not possible, due to “__getStatic” not existing in PHP!
	 *
	 * @group ignore
	 */
	public function testConstant()
	{
		$this->assertEquals(100, StatusCode::CONTINUE);
		$this->assertEquals(101, StatusCode::SWITCHING_PROTOCOLS);
		$this->assertEquals(102, StatusCode::PROCESSING);
		$this->assertEquals(511, StatusCode::NETWORK_AUTHENTICATION_REQUIRED);
	}

	public function testConstructor()
	{
		$instance = new StatusCode(100);
		$this->assertInstanceOf(StatusCode::class, $instance);
	}

	public function testCallStatic()
	{
		$instance = StatusCode::CONTINUE();
		$this->assertInstanceOf(StatusCode::class, $instance);
	}

	public function testGetters()
	{
		$instance = StatusCode::CONTINUE();
		$this->assertEquals('CONTINUE', $instance->getIdentifier());
		$this->assertEquals(100, $instance->getValue());
	}

	public function testToString()
	{
		$instance = new StatusCode(100);
		$this->assertEquals(100, (string) $instance);
	}

	public function testDefaultValue()
	{
		$instance = new StatusCode();
		$this->assertInstanceOf(StatusCode::class, $instance);
		$this->assertEquals(200, (string) $instance);
	}

	public function testIdentifiers()
	{
		$identifiers = StatusCode::identifiers();

		$this->assertIsArray($identifiers);

		$this->assertContains('CONTINUE', $identifiers);
		$this->assertContains('SWITCHING_PROTOCOLS', $identifiers);
		$this->assertContains('PROCESSING', $identifiers);
		$this->assertContains('NETWORK_AUTHENTICATION_REQUIRED', $identifiers);
	}

	public function testIsValidIdentifier()
	{
		$this->assertTrue(StatusCode::isValidIdentifier('PROCESSING'));
		$this->assertFalse(StatusCode::isValidIdentifier('BROKEN'));
	}

	public function testValues()
	{
		$values = StatusCode::values();

		$this->assertIsArray($values);

		$this->assertContains(100, $values);
		$this->assertContains(101, $values);
		$this->assertContains(102, $values);
		$this->assertContains(511, $values);
	}

	public function testIsValidValue()
	{
		$this->assertTrue(StatusCode::isValidValue(100));
		$this->assertFalse(StatusCode::isValidValue(700));
	}

	public function testToIdentifier()
	{
		$this->assertEquals('CONTINUE', StatusCode::toIdentifier(100));
	}

	public function testToIdentifierWithInstance()
	{
		$this->assertEquals('CONTINUE', StatusCode::toIdentifier(new StatusCode(100)));
	}

	public function testToValue()
	{
		$this->assertEquals(100, StatusCode::toValue('CONTINUE'));
	}

	public function testToValueWithInstance()
	{
		$this->assertEquals(100, StatusCode::toValue(new StatusCode(100)));
	}
}
