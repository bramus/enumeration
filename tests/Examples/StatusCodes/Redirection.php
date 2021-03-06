<?php

namespace Tests\Bramus\Enumeration\Examples\StatusCodes;

use Bramus\Enumeration\Enumeration;

abstract class Redirection extends Enumeration
{
	/**
	 * The target resource has more than one representation, each with its own more specific identifier, and information about the alternatives is being provided so that the user (or user agent) can select a preferred representation by redirecting its request to one or more of those identifiers.
	 *
	 * In other words, the server desires that the user agent engage in reactive negotiation to select the most appropriate representation(s) for its needs.
	 * If the server has a preferred choice, the server SHOULD generate a Location header field containing a preferred choice's URI reference. The user agent MAY use the Location field value for automatic redirection.
	 * For request methods other than HEAD, the server SHOULD generate a payload in the 300 response containing a list of representation metadata and URI reference(s) from which the user or user agent can choose the one most preferred. The user agent MAY make a selection from that list automatically if it understands the provided media type. A specific format for automatic selection is not defined by this specification because HTTP tries to remain orthogonal to the definition of its payloads. In practice, the representation is provided in some easily parsed format believed to be acceptable to the user agent, as determined by shared design or content negotiation, or in some commonly accepted hypertext format.
	 * A 300 response is cacheable by default; i.e., unless otherwise indicated by the method definition or explicit cache controls.
	 * Note: The original proposal for the 300 status code defined the URI header field as providing a list of alternative representations, such that it would be usable for 200, 300, and 406 responses and be transferred in responses to the HEAD method. However, lack of deployment and disagreement over syntax led to both URI and Alternfates (a subsequent proposal) being dropped from this specification. It is possible to communicate the list using a set of Link header fields, each with a relationship of "alternate", though deployment is a chicken-and-egg problem.
	 */
	const MULTIPLE_CHOICES = 300;

	/**
	 * The target resource has been assigned a new permanent URI and any future references to this resource ought to use one of the enclosed URIs.
	 *
	 * Clients with link-editing capabilities ought to automatically re-link references to the effective request URI to one or more of the new references sent by the server, where possible.
	 * The server SHOULD generate a Location header field in the response containing a preferred URI reference for the new permanent URI. The user agent MAY use the Location field value for automatic redirection. The server's response payload usually contains a short hypertext note with a hyperlink to the new URI(s).
	 * Note: For historical reasons, a user agent MAY change the request method from POST to GET for the subsequent request. If this behavior is undesired, the 307 Temporary Redirect status code can be used instead.
	 * A 301 response is cacheable by default; i.e., unless otherwise indicated by the method definition or explicit cache controls.
	 */
	const MOVED_PERMANENTLY = 301;

	/**
	 * The target resource resides temporarily under a different URI. Since the redirection might be altered on occasion, the client ought to continue to use the effective request URI for future requests.
	 *
	 * The server SHOULD generate a Location header field in the response containing a URI reference for the different URI. The user agent MAY use the Location field value for automatic redirection. The server's response payload usually contains a short hypertext note with a hyperlink to the different URI(s).
	 * Note: For historical reasons, a user agent MAY change the request method from POST to GET for the subsequent request. If this behavior is undesired, the 307 Temporary Redirect status code can be used instead.
	 */
	const FOUND = 302;

	// …
}
