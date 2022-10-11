<?php

namespace Phlib\String;

class StringTest extends \PHPUnit_Framework_TestCase
{

    public function testNoEllipsis()
    {
        $this->assertSame('Hello world', ellipsis('Hello world', 100));
    }

    public function testDefaultEllipsis()
    {
        $this->assertSame('Hello w...', ellipsis('Hello world', 10));
    }

    public function testCustomEllipsis()
    {
        $this->assertSame('Hello w,,,', ellipsis('Hello world', 10, ',,,'));
    }

    public function testCustomEllipsisDifferentLength()
    {
        $this->assertSame('Hello ;;;;', ellipsis('Hello world', 10, ';;;;'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLengthZero()
    {
        ellipsis('Hello world', 0);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLengthWord()
    {
        ellipsis('Hello world', 'oops');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLengthTooBig()
    {
        ellipsis('Hello world', PHP_INT_MAX + 1);
    }
}
