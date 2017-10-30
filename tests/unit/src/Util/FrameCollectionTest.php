<?php

class FrameCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var \League\BooBoo\Util\FrameCollection
     */
    protected $container;

    protected function setUp()
    {
        $this->exception = new Exception;
        $this->container = new \League\BooBoo\Util\FrameCollection($this->exception->getTrace());
    }

    public function testFrameOffsetFunctions()
    {
        $collection = $this->container;
        $this->assertTrue((bool)$collection->offsetExists(0));
        $this->assertFalse((bool)$collection->offsetExists(4000));
        $this->assertInstanceOf('League\BooBoo\Util\Frame', $collection->offsetGet(0));
    }

    public function testFrameCountIsAccurate()
    {
        $count = count($this->exception->getTrace());
        $collection = $this->container;
        $this->assertEquals($count, $collection->count());
    }

    /**
     * @expectedException \Exception
     */
    public function testOffsetSetRaisesException()
    {
        $collection = $this->container;
        $collection->offsetSet(1, 2);
    }

    /**
     * @expectedException \Exception
     */
    public function testOffsetUnsetRaisesException()
    {
        $collection = $this->container;
        $collection->offsetUnset(1);
    }
}