<?php

namespace Tests\Bramus\Enumeration\Examples\StatusCodes;

use Bramus\Enumeration\Enumeration;

abstract class Success extends Enumeration
{
	/**
	 * The request has succeeded.
	 *
	 * The payload sent in a 200 response depends on the request method. For the methods defined by this specification, the intended meaning of the payload can be summarized as:
	 * 	- GET a representation of the target resource
	 * 	- HEAD the same representation as GET, but without the representation data
	 * 	- POST a representation of the status of, or results obtained from, the action;
	 * 	- PUT DELETE a representation of the status of the action;
	 * 	- OPTIONS a representation of the communications options;
	 * 	- TRACE a representation of the request message as received by the end server.
	 * Aside from responses to CONNECT, a 200 response always has a payload, though an origin server MAY generate a payload body of zero length. If no payload is desired, an origin server ought to send 204 No Content instead. For CONNECT, no payload is allowed because the successful result is a tunnel, which begins immediately after the 200 response header section.
	 * A 200 response is cacheable by default; i.e., unless otherwise indicated by the method definition or explicit cache controls.
	 */
	const OK = 200;

	/**
	 * The request has been fulfilled and has resulted in one or more new resources being created.
	 *
	 * The primary resource created by the request is identified by either a Location header field in the response or, if no Location field is received, by the effective request URI.
	 * The 201 response payload typically describes and links to the resource(s) created. See Section 7.2 of RFC7231 for a discussion of the meaning and purpose of validator header fields, such as ETag and Last-Modified, in a 201 response.
	 */
	const CREATED = 201;

	/**
	 * The request has been accepted for processing, but the processing has not been completed. The request might or might not eventually be acted upon, as it might be disallowed when processing actually takes place.
	 *
	 * There is no facility in HTTP for re-sending a status code from an asynchronous operation.
	 * The 202 response is intentionally noncommittal. Its purpose is to allow a server to accept a request for some other process (perhaps a batch-oriented process that is only run once per day) without requiring that the user agent's connection to the server persist until the process is completed. The representation sent with this response ought to describe the request's current status and point to (or embed) a status monitor that can provide the user with an estimate of when the request will be fulfilled.
	 */
	const ACCEPTED = 202;

	// …
}
