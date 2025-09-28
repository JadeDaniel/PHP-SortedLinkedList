<?php declare(strict_types = 1);

namespace Jade;

use PHPUnit\Framework\TestCase;
use Throwable;

class SortedLinkedListTest extends TestCase
{

    public function testHappyPath(): void
    {
        $list = new SortedLinkedList();

        $list->add(10);
        $this->assertSame([10], $list->toArray());

        $list->add(4);
        $this->assertSame([4, 10], $list->toArray());

        $list->add(6);
        $this->assertSame([4, 6, 10], $list->toArray());

        $list->add(500);
        $this->assertSame([4, 6, 10, 500], $list->toArray());

        $list->add(350);
        $this->assertSame([4, 6, 10, 350, 500], $list->toArray());
    }

    public function testNegativeInts(): void
    {
        $list = new SortedLinkedList();
        $list->add(-10);
        $list->add(-4);
        $list->add(-6);
        $list->add(-500);
        $list->add(-350);
        $this->assertSame([-500, -350, -10, -6, -4], $list->toArray());
    }

    public function testChars(): void
    {
        $list = new SortedLinkedList();
        $list->add('d');
        $list->add('a');
        $list->add('c');
        $list->add('e');
        $list->add('b');
        $this->assertSame(['a', 'b', 'c', 'd', 'e'], $list->toArray());
    }

    public function testStrings(): void
    {
        $list = $this->sampleStringList();

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

    public function testBidirectionalTraversal(): void
    {
        $list = $this->sampleIntList();

        $node = $list->first();
        $this->assertNotNull($node);
        $this->assertEquals(4, $node->getValue());

        $node = $node->next();
        $this->assertNotNull($node);
        $this->assertEquals(6, $node->getValue());

        $node = $node->next();
        $this->assertNotNull($node);
        $this->assertEquals(10, $node->getValue());

        $node = $node->previous();
        $this->assertNotNull($node);
        $this->assertEquals(6, $node->getValue());

        $node = $node->previous();
        $this->assertNotNull($node);
        $this->assertEquals(4, $node->getValue());
    }

    public function testFind(): void
    {
        $list = $this->sampleIntList();
        $found = $list->find(6);
        $this->assertNotNull($found);
        $this->assertEquals($found, $list->first()?->next());

        $list = $this->sampleStringList();
        $found = $list->find('Zanzibar');
        $this->assertNotNull($found);
        $this->assertEquals($found, $list->first()?->next()?->next());

        $this->assertNull($list->find('Zebra'));
    }

    public function testRemoval(): void
    {
        $list = $this->sampleIntList();
        $this->assertSame([4, 6, 10], $list->toArray());

        $list->find(6)?->remove();
        $this->assertSame([4, 10], $list->toArray());
    }

    public function sampleIntList(): SortedLinkedList
    {
        $list = new SortedLinkedList();
        $list->add(10);
        $list->add(4);
        $list->add(6);
        return $list;
    }

    public function sampleStringList(): SortedLinkedList
    {
        $list = new SortedLinkedList();
        $list->add('Zanzibar');
        $list->add('Africa');
        $list->add('Botswana');
        $list->add('Zanzicar');
        return $list;
    }

}
