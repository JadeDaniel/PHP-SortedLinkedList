<?php declare(strict_types = 1);

namespace Jade;

use PHPUnit\Framework\TestCase;
use Throwable;

class SortedLinkedListTest extends TestCase
{

    public function testHappyPath(): void
    {
        $list = new SortedLinkedList();

        $list->add(new IntNode(10));
        $this->assertSame([10], $list->toArray());

        $list->add(new IntNode(4));
        $this->assertSame([4, 10], $list->toArray());

        $list->add(new IntNode(6));
        $this->assertSame([4, 6, 10], $list->toArray());

        $list->add(new IntNode(500));
        $this->assertSame([4, 6, 10, 500], $list->toArray());

        $list->add(new IntNode(350));
        $this->assertSame([4, 6, 10, 350, 500], $list->toArray());
    }

    public function testNegativeInts(): void
    {
        $list = new SortedLinkedList();
        $list->add(new IntNode(-10));
        $list->add(new IntNode(-4));
        $list->add(new IntNode(-6));
        $list->add(new IntNode(-500));
        $list->add(new IntNode(-350));
        $this->assertSame([-500, -350, -10, -6, -4], $list->toArray());
    }

    public function testChars(): void
    {
        $list = new SortedLinkedList();
        $list->add(new StringNode('d'));
        $list->add(new StringNode('a'));
        $list->add(new StringNode('c'));
        $list->add(new StringNode('e'));
        $list->add(new StringNode('b'));
        $this->assertSame(['a', 'b', 'c', 'd', 'e'], $list->toArray());
    }

    public function testStrings(): void
    {
        $list = new SortedLinkedList();
        $list->add(new StringNode('Zanzibar'));
        $list->add(new StringNode('Africa'));
        $list->add(new StringNode('Botswana'));
        $list->add(new StringNode('Zanzicar'));

        $this->assertSame([
            'Africa',
            'Botswana',
            'Zanzibar',
            'Zanzicar',
        ], $list->toArray());
    }

    public function testMixed(): void
    {
        $list = new SortedLinkedList();
        $list->add(new StringNode('Zanzibar'));

        $this->expectException(Throwable::class);

        $list->add(new IntNode(10));
    }

}
