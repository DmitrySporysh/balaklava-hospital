<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\DoctorService;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHasItemInBox()
    {
        $box = new Box(['cat', 'toy', 'torch']);

        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }

    public function testTakeOneFromTheBox()
    {
        $box = new Box(['torch']);

        $this->assertEquals('torch', $box->takeOne());

        // Null, now the box is empty
        $this->assertNull($box->takeOne());
    }

    public function testStartsWithALetter()
    {
        $box = new Box(['toy', 'torch', 'ball', 'cat', 'tissue']);

        $results = $box->startsWith('t');

        $this->assertCount(3, $results);
        $this->assertContains('toy', $results);
        $this->assertContains('torch', $results);
        $this->assertContains('tissue', $results);

        // Empty array if passed even
        $this->assertEmpty($box->startsWith('s'));
    }
}

class Box
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * Construct the box with the given items.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * Check if the specified item is in the box.
     *
     * @param string $item
     * @return bool
     */
    public function has($item)
    {
        return in_array($item, $this->items);
    }

    /**
     * Remove an item from the box, or null if the box is empty.
     *
     * @return string
     */
    public function takeOne()
    {
        return array_shift($this->items);
    }

    /**
     * Retrieve all items from the box that start with the specified letter.
     *
     * @param string $letter
     * @return array
     */
    public function startsWith($letter)
    {
        return array_filter($this->items, function ($item) use ($letter) {
            return stripos($item, $letter) === 0;
        });
    }
}
