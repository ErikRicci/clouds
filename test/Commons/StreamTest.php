<?php

namespace Clouds\Commons;

use Clouds\Utils\Math\Pythagoras;
use PHPUnit\Framework\TestCase;

class StreamTest extends TestCase
{
    public function testConstructor()
    {
        $content = [1, 2, 3];
        $details = ['foo' => 'bar'];
        $stream = new Stream($content, $details);

        $this->assertSame($details, $stream->get());
        $this->assertSame($details, $stream->getDetails());
    }

    public function testWhere()
    {
        $content = [1, 2, 3];
        $details = ['foo' => 'bar'];
        $stream = new Stream($content, $details);

        $callback = function ($v) {
            return $v > 1;
        };

        $stream->where($callback);

        $this->assertSame([2, 3], $stream->get());
    }

    public function testWhereLike()
    {
        $content = ['foo', 'bar', 'baz'];
        $details = ['foo' => 'bar'];
        $stream = new Stream($content, $details);

        $stream->whereLike('foo', 'a');

        $this->assertSame(['foo', 'bar'], $stream->get());
    }

    public function testGet()
    {
        $content = [1, 2, 3];
        $details = ['foo' => 'bar'];
        $stream = new Stream($content, $details);

        $this->assertSame($content, $stream->get());
    }

    public function testCount()
    {
        $content = [1, 2, 3];
        $details = ['foo' => 'bar'];
        $stream = new Stream($content, $details);

        $this->assertSame(3, $stream->count());
    }

    public function testGetDetails()
    {
        $content = [1, 2, 3];
        $details = ['foo' => 'bar'];
        $stream = new Stream($content, $details);

        $this->assertSame($details, $stream->getDetails());
    }
}
