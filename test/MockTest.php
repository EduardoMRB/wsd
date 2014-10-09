<?php
require __DIR__ . '/vendor/autoload.php';

use \Mockery as M;

class Source
{
	/** impl **/
}

class Adder
{
	public function __construct($source)
	{
		$this->source = $source;
	}

	public function calc()
	{
		return array_reduce($this->source->getValues(), function ($memo, $n) {
			return $memo + $n;
		});
	}

	public function concat($firstName, $lastName)
	{
		return $firstName. ' ' .$lastName;

	}
}

class MockTest extends \PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		M::close();
	}

	public function testValuesAreSummedUpCorrectly()
	{
		$values = [1, 2, 3];
		$source = M::mock(['getValues' => $values]);
		$adder = new Adder($source);

		$this->assertEquals(6, $adder->calc());
	}

	public function testConcatNames()
	{
		$firstName = 'Erick';
		$lastName  = 'Leandro';
		$source = M::mock();
		$adder = new Adder($source);

	}
}