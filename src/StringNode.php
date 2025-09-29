<?php declare(strict_types = 1);

namespace Jade;

use Exception;

class StringNode extends Node
{

    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public function value(): string
    {
        return (string) parent::value();
    }

    /**
     * @throws Exception
     */
    public function greaterThan(Node $other): bool
    {
        if (!$other instanceof StringNode) {
            throw new Exception('Invalid comparison between StringNode and ' . $other::class);
        }
        return $this->value() > $other->value();
    }

}
