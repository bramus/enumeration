<?php

namespace Tests\Bramus\Enumeration\Helpers;

use PHPUnit\Framework\TestCase;
use Tests\Bramus\Enumeration\Examples\Helpers\Generator;
use Tests\Bramus\Enumeration\Examples\StatusCode;
use Tests\Bramus\Enumeration\Examples\Weekday;

/**
 * @internal
 * @coversDefaultClass \Bramus\Enumeration\Helpers\Generator
 */
class GeneratorTest extends TestCase
{
	public function testRandom()
	{
		$generated = Generator::generateWeekday();
		$this->assertInstanceOf(Weekday::class, $generated);
		$this->assertContains($generated->getValue(), Weekday::values());
	}

	public function testGivenValue()
	{
		$generated = Generator::generateWeekday(Weekday::MONDAY);
		$this->assertInstanceOf(Weekday::class, $generated);
		$this->assertEquals('MONDAY', $generated->getIdentifier());
	}

	public function testGivenValueAsInstance()
	{
		$instance = Weekday::MONDAY();
		$generated = Generator::generateWeekday($instance);
		$this->assertEquals($instance, $generated);
	}

	public function testInvalidArgument()
	{
		$this->expectException(\InvalidArgumentException::class);
		$generated = Generator::generateInexistent();
	}

	public function testComposedEnumeration()
	{
		$generated = Generator::generateStatusCode();
		$this->assertInstanceOf(StatusCode::class, $generated);
		$this->assertContains($generated->getValue(), StatusCode::values());
	}
}
