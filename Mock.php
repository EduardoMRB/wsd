<?php

require_once 'vendor/autoload.php';
 
class Mock extends PHPUnit_Framework_TestCase 
{
 
    protected function tearDown() {
        \Mockery::close();
    }
 
    function testExpectOnce() {
        $someObject = new SomeClass();
 
        // With PHPUnit
        $phpunitMock = $this->getMock('AClassToBeMocked');
        $phpunitMock->expects($this->once())->method('someMethod');
        // Exercise for PHPUnit
        $someObject->doSomething($phpunitMock);
 
        // With Mockery
        $mockeryMock = \Mockery::mock('AnInexistentClass');
        $mockeryMock->shouldReceive('someMethod')->once();
        // Exercise for Mockery
        $someObject->doSomething($mockeryMock);
    }

    function testExpectMultiple() 
    {
	    $someObject = new SomeClass();
	 
	    // With PHPUnit 2 times
	    $phpunitMock = $this->getMock('AClassToBeMocked');
	    $phpunitMock->expects($this->exactly(2))->method('someMethod');
	    // Exercise for PHPUnit
	    $someObject->doSomething($phpunitMock);
	    $someObject->doSomething($phpunitMock);
	 
	    // With Mockery 2 times
	    $mockeryMock = \Mockery::mock('AnInexistentClass');
	    $mockeryMock->shouldReceive('someMethod')->twice();
	    // Exercise for Mockery
	    $someObject->doSomething($mockeryMock);
	    $someObject->doSomething($mockeryMock);
	 
	    // With Mockery 3 times
	    $mockeryMock = \Mockery::mock('AnInexistentClass');
	    $mockeryMock->shouldReceive('someMethod')->times(3);
	    // Exercise for Mockery
	    $someObject->doSomething($mockeryMock);
	    $someObject->doSomething($mockeryMock);
	    $someObject->doSomething($mockeryMock);
	}

	function testSimpleReturnValue() 
	{
        $someObject = new SomeClass();
        $someValue = 'some value';
 
        // With PHPUnit
        $phpunitMock = $this->getMock('AClassToBeMocked');
        $phpunitMock->expects($this->once())->method('someMethod')->will($this->returnValue($someValue));
        // Expect the returned value
        $this->assertEquals($someValue, $someObject->doSomething($phpunitMock));
 
 
        // With Mockery
        $mockeryMock = \Mockery::mock('AnInexistentClass');
        $mockeryMock->shouldReceive('someMethod')->once()->andReturn($someValue);
        // Expect the returned value
        $this->assertEquals($someValue, $someObject->doSomething($mockeryMock));
    }	
 
}
 
class AClassToBeMocked {
    function someMethod() {}
}
 
class SomeClass {
    function doSomething($anotherObject) {
        $anotherObject->someMethod();
    }
}