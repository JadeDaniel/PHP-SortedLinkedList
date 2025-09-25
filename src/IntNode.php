<?php

namespace Jade;

use Exception;

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