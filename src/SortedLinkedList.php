<?php
//namespace Jade::SortedLinkedList;
//
//lets also demo this
//what is our demo use case for design?
//    We're a fullment shipmonk
//Maybe we want a linked list of what.. order numbers?
//Maybe it's like sequences, events. Something that we care about which came first and which came next.
//Strings...
//Maybe it's a way of storing ah shipment updates?
//Why not time series, why LL?



abstract class Node
{
    public function __toString(): string {
        return (string)$this->value;
    }

    public function __construct(int|string $value)
    {
        $this->value = $value;
    }

    private int|string $value;

    private ?Node $next = null;
    private ?Node $prev = null;

    function getValue(): int|string
    {
        return $this->value;
    }

    function next(): ?Node
    {
        return $this->next;
    }

    abstract function greaterThan(Node $other): bool;

    function append(Node $node): void
    {
        $temp = $this->next;
        $this->next = $node;
        $node->next = $temp;
    }

    function prepend(Node $node): void
    {
        $temp = $this->prev;
        $this->prev = $node;
        $node->prev = $temp;
        $node->next = $this;
    }

}

class StringNode extends Node {
    public function __construct(string $value) {
        parent::__construct($value);
    }

    public function getValue(): string
    {
        return (string) parent::getValue();
    }

    /**
     * @throws Exception
     */
    function greaterThan(Node $other): bool
    {
        if (!$other instanceof StringNode) {
            throw new Exception("Invalid comparison between StringNode and " . $other::class);
        }
        return $this->getValue() > $other->getValue();
    }
}

class IntNode extends Node {
    public function __construct(int $value) {
        parent::__construct($value);
    }

    public function getValue(): int
    {
        return (int)parent::getValue();
    }

    function greaterThan(Node $other): bool
    {
        if (!$other instanceof IntNode) {
            throw new Exception("Invalid comparison between IntNode and " . $other::class);
        }
        return $this->getValue() > $other->getValue();
    }
}

class SortedLinkedList
{
    public function __toString(): string {
        if ($this->head === null ) {
            return "Empty List";
        }

        $n = $this->head;
        while( $n->next() !== null ) {
            echo $n->getValue() . " ";
            $n = $n->next();
        }
        echo $n->getValue() . " ";
        return "";
    }

    private ?Node $head = null;

    /**
     * @throws Exception
     */
    private function findPrecedent(Node $new): ?Node {
        if ($this->head === null) {
            throw new Exception("findPrecedent must not be called on an empty list");
        }

        if ($this->head->greaterThan($new)) {
            return null;
        }

        $candidate = $this->head;

        while( $new->greaterThan($candidate)) {
            if ( $candidate->next() === null) return $candidate;

            if ( $candidate->next()->greaterThan($new)) return $candidate;
            $candidate = $candidate->next();
        }

        return $candidate;
    }



    public function add(Node $new): void
    {
        // TODO guard only right types added! Also cover in test suite
        if ($this->head === null)
        {
            $this->head = $new;
            return;
        }

        if ($this->head::class !== $new::class) {
            throw new Exception("Cannot add a " . $new::class . " node to a ". $this->head::class . " list.");
        }

        $precedent = $this->findPrecedent($new);
        if ($precedent === null) {
            $this->head->prepend($new);
            $this->head = $new;
        } else {
            $precedent->append($new);
        }
    }
}

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