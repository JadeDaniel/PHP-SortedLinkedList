<?php

namespace Jade;

use Exception;

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