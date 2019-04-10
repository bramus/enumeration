<?php

namespace Tests\Bramus\Enumeration\Helpers;

use Bramus\Enumeration\Helpers\Extractor;
use PHPUnit\Framework\TestCase;
use Tests\Bramus\Enumeration\Examples\NotAnEnumeration;
use Tests\Bramus\Enumeration\Examples\StatusCode;
use Tests\Bramus\Enumeration\Examples\Weekday;

/**
 * @internal
 * @coversDefaultClass \Bramus\Enumeration\Helpers\Extractor
 */
class ExtractorTest extends TestCase
{
	public function testExtractConstants()
	{
		$constants = Extractor::extractConstants(Weekday::class);

		$this->assertIsArray($constants);
		$this->assertCount(7, $constants);

		$this->assertArrayHasKey('MONDAY', $constants);
		$this->assertArrayHasKey('SUNDAY', $constants);

		$this->assertEquals(1, $constants['MONDAY']);
		$this->assertEquals(7, $constants['SUNDAY']);
	}

	public function testExtractConstantsWithDefaultIncluded()
	{
		$constants = Extractor::extractConstants(Weekday::class, false);

		$this->assertIsArray($constants);
		$this->assertCount(8, $constants);

		$this->assertArrayHasKey('MONDAY', $constants);
		$this->assertArrayHasKey('SUNDAY', $constants);
		$this->assertArrayHasKey('__DEFAULT', $constants);

		$this->assertEquals(1, $constants['MONDAY']);
		$this->assertEquals(7, $constants['SUNDAY']);
		$this->assertEquals(null, $constants['__DEFAULT']);
	}

	public function testExtractIdentifiers()
	{
		$identifiers = Extractor::extractIdentifiers(Weekday::class);

		$this->assertIsArray($identifiers);
		$this->assertCount(7, $identifiers);

		$this->assertContains('MONDAY', $identifiers);
		$this->assertContains('SUNDAY', $identifiers);
	}

	public function testExtractIdentifiersWithDefaultIncluded()
	{
		$identifiers = Extractor::extractIdentifiers(Weekday::class, false);

		$this->assertIsArray($identifiers);
		$this->assertCount(8, $identifiers);

		$this->assertContains('MONDAY', $identifiers);
		$this->assertContains('SUNDAY', $identifiers);
		$this->assertContains('__DEFAULT', $identifiers);
	}

	public function testExtractValues()
	{
		$values = Extractor::extractValues(Weekday::class);

		$this->assertIsArray($values);
		$this->assertCount(7, $values);

		$this->assertContains(7, $values);
		$this->assertContains(1, $values);
	}

	public function testExtractValuesWithDefaultIncluded()
	{
		$values = Extractor::extractValues(Weekday::class, false);

		$this->assertIsArray($values);
		$this->assertCount(8, $values);

		$this->assertContains(1, $values);
		$this->assertContains(7, $values);
		$this->assertContains(null, $values);
	}

	public function testInvalidArgument()
	{
		$this->expectException(\InvalidArgumentException::class);
		Extractor::extractConstants(NotAnEnumeration::class);
	}

	public function testExtractConstantsForComposedEnumeration()
	{
		$constants = Extractor::extractConstants(StatusCode::class);

		$this->assertIsArray($constants);

		$this->assertArrayHasKey('CONTINUE', $constants);
		$this->assertContains(100, $constants);

		$this->assertArrayHasKey('NETWORK_AUTHENTICATION_REQUIRED', $constants);
		$this->assertContains(511, $constants);
	}

	public function testExtractValuesForComposedEnumeration()
	{
		$values = Extractor::extractValues(StatusCode::class);

		$this->assertIsArray($values);
		$this->assertContains(100, $values);
		$this->assertContains(511, $values);
	}

	public function testExtractIdentifiersForComposedEnumeration()
	{
		$identifiers = Extractor::extractIdentifiers(StatusCode::class);

		$this->assertIsArray($identifiers);
		$this->assertContains('CONTINUE', $identifiers);
		$this->assertContains('NETWORK_AUTHENTICATION_REQUIRED', $identifiers);
	}
}
