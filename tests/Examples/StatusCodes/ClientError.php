<?php

namespace Tests\Bramus\Enumeration\Examples\StatusCodes;

use Bramus\Enumeration\Enumeration;

abstract class ClientError extends Enumeration
{
	/**
	 * The server cannot or will not process the request due to something that is perceived to be a client error (e.g., malformed request syntax, invalid request message framing, or deceptive request routing).
	 */
	const BAD_REQUEST = 400;

	/**
	 * The request has not been applied because it lacks valid authentication credentials for the target resource.
	 *
	 * The server generating a 401 response MUST send a WWW-Authenticate header field containing at least one challenge applicable to the target resource.
	 * If the request included authentication credentials, then the 401 response indicates that authorization has been refused for those credentials. The user agent MAY repeat the request with a new or replaced Authorization header field. If the 401 response contains the same challenge as the prior response, and the user agent has already attempted authentication at least once, then the user agent SHOULD present the enclosed representation to the user, since it usually contains relevant diagnostic information.
	 */
	const UNAUTHORIZED = 401;

	/**
	 * Reserved for future use.
	 */
	const PAYMENT_REQUIRED = 402;

	// …

	/**
	 * Any attempt to brew coffee with a teapot should result in the error code "418 I'm a teapot". The resulting entity body MAY be short and stout.
	 */
	const IM_A_TEAPOT = 418;

	// …
}
