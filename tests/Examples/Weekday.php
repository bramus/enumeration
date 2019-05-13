<?php

namespace Tests\Bramus\Enumeration\Examples;

use Bramus\Enumeration\Enumeration;

class Weekday extends Enumeration
{
	const __DEFAULT = 1;

	/**
	 * Monday.
	 *
	 * The first day of the week
	 */
	const MONDAY = 1;

	/**
	 * Tuesday.
	 *
	 * The second day of the week
	 */
	const TUESDAY = 2;

	/**
	 * Wednesday.
	 *
	 * The third day of the week
	 */
	const WEDNESDAY = 3;

	/**
	 * Thursday.
	 *
	 * The fourth day of the week
	 */
	const THURSDAY = 4;

	/**
	 * Friday.
	 *
	 * The fifth day of the week
	 */
	const FRIDAY = 5;

	/**
	 * Saturday.
	 *
	 * The sixth day of the week
	 */
	const SATURDAY = 6;

	/**
	 * Sunday.
	 *
	 * The seventh day of the week
	 */
	const SUNDAY = 7;
}
