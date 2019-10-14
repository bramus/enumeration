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

	public function testToSummary()
	{
		$this->assertEquals('The initial part of a request has been received and has not yet been rejected by the server. The server intends to send a final response after the request has been fully received and acted upon.', StatusCode::toSummary(100));
	}

	public function testToSummaryWithInstance()
	{
		$this->assertEquals('The initial part of a request has been received and has not yet been rejected by the server. The server intends to send a final response after the request has been fully received and acted upon.', StatusCode::toSummary(new StatusCode(100)));
	}

	public function testToSummaryForDefault()
	{
		$this->assertEquals('The request has succeeded.', StatusCode::toSummary(new StatusCode()));
	}

	public function testSummaries()
	{
		$summaries = StatusCode::summaries();

		$this->assertIsArray($summaries);
		$this->assertCount(17, $summaries);

		$this->assertContains(StatusCode::toSummary(200), $summaries);
		$this->assertEquals(StatusCode::toSummary(200), $summaries[(string) StatusCode::OK()]);
	}

	public function testToDescription()
	{
		$this->assertEquals("When the request contains an Expect header field that includes a 100-continue expectation, the 100 response indicates that the server wishes to receive the request payload body. The client ought to continue sending the request and discard the 100 response.\nIf the request did not contain an Expect header field containing the 100-continue expectation, the client can simply discard this interim response.", StatusCode::toDescription(100));
	}

	public function testToDescriptionWithInstance()
	{
		$this->assertEquals("When the request contains an Expect header field that includes a 100-continue expectation, the 100 response indicates that the server wishes to receive the request payload body. The client ought to continue sending the request and discard the 100 response.\nIf the request did not contain an Expect header field containing the 100-continue expectation, the client can simply discard this interim response.", StatusCode::toDescription(new StatusCode(100)));
	}

	public function testToDescriptionForDefault()
	{
		$this->assertEquals("The payload sent in a 200 response depends on the request method. For the methods defined by this specification, the intended meaning of the payload can be summarized as:\n	- GET a representation of the target resource\n	- HEAD the same representation as GET, but without the representation data\n	- POST a representation of the status of, or results obtained from, the action;\n	- PUT DELETE a representation of the status of the action;\n	- OPTIONS a representation of the communications options;\n	- TRACE a representation of the request message as received by the end server.\nAside from responses to CONNECT, a 200 response always has a payload, though an origin server MAY generate a payload body of zero length. If no payload is desired, an origin server ought to send 204 No Content instead. For CONNECT, no payload is allowed because the successful result is a tunnel, which begins immediately after the 200 response header section.\nA 200 response is cacheable by default; i.e., unless otherwise indicated by the method definition or explicit cache controls.", StatusCode::toDescription(new StatusCode()));
	}
}
