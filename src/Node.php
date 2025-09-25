<?php

namespace Jade;

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