<?php

namespace Tests\Bramus\Enumeration\Examples\StatusCodes;

use Bramus\Enumeration\Enumeration;

abstract class ServerError extends Enumeration
{
	/**
	 * The server encountered an unexpected condition that prevented it from fulfilling the request.
	 */
	const INTERNAL_SERVER_ERROR = 500;

	/**
	 * The server does not support the functionality required to fulfill the request.
	 *
	 * This is the appropriate response when the server does not recognize the request method and is not capable of supporting it for any resource.
	 * A 501 response is cacheable by default; i.e., unless otherwise indicated by the method definition or explicit cache controls.
	 */
	const NOT_IMPLEMENTED = 501;

	/**
	 * The server, while acting as a gateway or proxy, received an invalid response from an inbound server it accessed while attempting to fulfill the request.
	 */
	const BAD_GATEWAY = 502;

	// …

	/**
	 * The client needs to authenticate to gain network access.
	 *
	 * The response representation SHOULD contain a link to a resource that allows the user to submit credentials (e.g., with an HTML form).
	 * Note that the 511 response SHOULD NOT contain a challenge or the login interface itself, because browsers would show the login interface as being associated with the originally requested URL, which may cause confusion.
	 * The 511 status SHOULD NOT be generated by origin servers; it is intended for use by intercepting proxies that are interposed as a means of controlling access to the network.
	 * Responses with the 511 status code MUST NOT be stored by a cache.
	 * The 511 status code is designed to mitigate problems caused by "captive portals" to software (especially non-browser agents) that is expecting a response from the server that a request was made to, not the intervening network infrastructure. It is not intended to encourage deployment of captive portals -- only to limit the damage caused by them.
	 * A network operator wishing to require some authentication, acceptance of terms, or other user interaction before granting access usually does so by identifying clients who have not done so ("unknown clients") using their Media Access Control (MAC) addresses.
	 * Unknown clients then have all traffic blocked, except for that on TCP port 80, which is sent to an HTTP server (the "login server") dedicated to "logging in" unknown clients, and of course traffic to the login server itself.
	 *
	 * The 511 status code assures that non-browser clients will not interpret the response as being from the origin server, and the META HTML element redirects the user agent to the login server.
	 */
	const NETWORK_AUTHENTICATION_REQUIRED = 511;
}
