<?php
namespace Jade;

use PHPUnit\Framework\TestCase;

class SortedLinkedListTest extends TestCase
{

    public function testHappyPath(): void
    {
        $list = new SortedLinkedList();
        $list->add(new IntNode(10));
        echo $list;
        echo "\n";

        $list->add(new IntNode(4));
        echo $list;
        echo "\n";

        $list->add(new IntNode(6));
        echo $list;
        echo "\n";

        $list->add(new IntNode(500));
        echo $list;
        echo "\n";

        $list->add(new IntNode(350));
        echo $list;
        echo "\n";
    }
}