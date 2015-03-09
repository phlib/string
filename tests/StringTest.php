<?php

namespace Phlib\Tests;

use Phlib\String;

class StringTest extends \PHPUnit_Framework_TestCase
{

    public function testNoEllipsis()
    {
        $this->assertSame('Hello world', String::ellipsis('Hello world', 100));
    }

    public function testDefaultEllipsis()
    {
        $this->assertSame('Hello w...', String::ellipsis('Hello world', 10));
    }

    public function testCustomEllipsis()
    {
        $this->assertSame('Hello w,,,', String::ellipsis('Hello world', 10, ',,,'));
    }

    public function testCustomEllipsisDifferentLength()
    {
        $this->assertSame('Hello ;;;;', String::ellipsis('Hello world', 10, ';;;;'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLengthZero()
    {
        String::ellipsis('Hello world', 0);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLengthWord()
    {
        String::ellipsis('Hello world', 'oops');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLengthTooBig()
    {
        String::ellipsis('Hello world', PHP_INT_MAX + 1);
    }
}
