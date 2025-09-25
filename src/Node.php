<?php declare(strict_types = 1);

namespace Jade;

abstract class Node
{

    private int|string $value;

    private ?Node $next = null;
    private ?Node $prev = null;

    public function __construct(int|string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function getValue(): int|string
    {
        return $this->value;
    }

    public function next(): ?Node
    {
        return $this->next;
    }

    abstract public function greaterThan(Node $other): bool;

    public function append(Node $node): void
    {
        $temp = $this->next;
        $this->next = $node;
        $node->next = $temp;
    }

    public function prepend(Node $node): void
    {
        $temp = $this->prev;
        $this->prev = $node;
        $node->prev = $temp;
        $node->next = $this;
    }

}
