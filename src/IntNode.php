<?php declare(strict_types = 1);

namespace Jade;

use Exception;

class IntNode extends Node
{

    public function __construct(int $value)
    {
        parent::__construct($value);
    }

    public function value(): int
    {
        return (int) parent::value();
    }

    public function greaterThan(Node $other): bool
    {
        if (!$other instanceof IntNode) {
            throw new Exception('Invalid comparison between IntNode and ' . $other::class);
        }
        return $this->value() > $other->value();
    }

}
