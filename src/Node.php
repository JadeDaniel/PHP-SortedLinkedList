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

    public function value(): int|string
    {
        return $this->value;
    }

    public function next(): ?Node
    {
        return $this->next;
    }

    public function previous(): ?Node
    {
        return $this->prev;
    }

    abstract public function greaterThan(Node $other): bool;

    public function insertAfter(Node $newNode): void
    {
        $temp = $this->next;
        $temp?->setPrevious($newNode);
        $newNode->setNext($temp);
        $newNode->setPrevious($this);
        $this->setNext($newNode);
    }

    public function insertBefore(Node $node): void
    {
        $temp = $this->prev;
        $temp?->setNext($node);
        $node->setPrevious($temp);
        $node->setNext($this);
        $this->setPrevious($node);
    }

    protected function setNext(?Node $node): void
    {
        $this->next = $node;
    }

    protected function setPrevious(?Node $node): void
    {
        $this->prev = $node;
    }

    public function remove(): void
    {
        $this->prev?->setNext($this->next);
        $this->next?->setPrevious($this->prev);
    }

}
