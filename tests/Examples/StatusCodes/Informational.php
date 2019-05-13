<?php

namespace Tests\Bramus\Enumeration\Examples\StatusCodes;

use Bramus\Enumeration\Enumeration;

abstract class Informational extends Enumeration
{
	/**
	 * The initial part of a request has been received and has not yet been rejected by the server. The server intends to send a final response after the request has been fully received and acted upon.
	 *
	 * When the request contains an Expect header field that includes a 100-continue expectation, the 100 response indicates that the server wishes to receive the request payload body. The client ought to continue sending the request and discard the 100 response.
	 * If the request did not contain an Expect header field containing the 100-continue expectation, the client can simply discard this interim response.
	 */
	const CONTINUE = 100;

	/**
	 * The server understands and is willing to comply with the client's request, via the Upgrade header field, for a change in the application protocol being used on this connection.
	 *
	 * The server MUST generate an Upgrade header field in the response that indicates which protocol(s) will be switched to immediately after the empty line that terminates the 101 response.
	 * It is assumed that the server will only agree to switch protocols when it is advantageous to do so. For example, switching to a newer version of HTTP might be advantageous over older versions, and switching to a real-time, synchronous protocol might be advantageous when delivering resources that use such features.
	 */
	const SWITCHING_PROTOCOLS = 101;

	/**
	 * An interim response used to inform the client that the server has accepted the complete request, but has not yet completed it.
	 *
	 * This status code SHOULD only be sent when the server has a reasonable expectation that the request will take significant time to complete. As guidance, if a method is taking longer than 20 seconds (a reasonable, but arbitrary value) to process the server SHOULD return a 102 (Processing) response. The server MUST send a final response after the request has been completed.Methods can potentially take a long period of time to process, especially methods that support the Depth header. In such cases the client may time-out the connection while waiting for a response. To prevent this the server may return a 102 Processing status code to indicate to the client that the server is still processing the method.
	 */
	const PROCESSING = 102;
}
