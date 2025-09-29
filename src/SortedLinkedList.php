<?php declare(strict_types = 1);

namespace Jade;

use Exception;
use InvalidArgumentException;
use function is_int;
use function is_string;

class SortedLinkedList
{

    private ?Node $head = null;

    /**
     * @param ?array<int|string> $values
     *
     * @throws Exception
     */
    public function __construct(?array $values = null)
    {
        if ($values) {
            foreach ($values as $value) {
                $this->add($value);
            }
        }
    }

    public function __toString(): string
    {
        if ($this->head === null) {
            return 'Empty List';
        }

        return join(", ", $this->toArray());
    }

    /**
     * @throws Exception
     */
    private function findPrecedent(Node $new): ?Node
    {
        if ($this->head === null) {
            throw new Exception('findPrecedent must not be called on an empty list');
        }

        if ($this->head->greaterThan($new)) {
            return null;
        }

        $candidate = $this->head;

        while ( $new->greaterThan($candidate)) {
            if ( $candidate->next() === null) {
                return $candidate;
            }

            if ( $candidate->next()->greaterThan($new)) {
                return $candidate;
            }
            $candidate = $candidate->next();
        }

        return $candidate;
    }

    /**
     * @throws Exception
     */
    public function add(Node|int|string $new): void
    {
        /**
         * For convenience, allow passing raw scalars (int or string) and create the appropriate node
         */

        $node = match (true) {
            is_string($new) => new StringNode($new),
            is_int($new) => new IntNode($new),
            $new instanceof Node => $new,
        };

        if ($this->head === null) {
            $this->head = $node;
            return;
        }

        if ($this->head::class !== $node::class) {
            throw new InvalidArgumentException('Cannot add a ' . $node::class . ' node to a ' . $this->head::class . ' list.');
        }

        $precedent = $this->findPrecedent($node);
        if ($precedent === null) {
            $this->head->insertBefore($node);
            $this->head = $node;
        } else {
            $precedent->insertAfter($node);
        }
    }

    /**
     * @return list<int|string>
     */
    public function toArray(): array
    {
        $array = [];
        $pointer = $this->head;
        while ($pointer !== null) {
            $array[] = $pointer->value();
            $pointer = $pointer->next();
        }
         return $array;
    }

    public function first(): ?Node
    {
        return $this->head;
    }

    public function find(int|string $value): ?Node
    {
        $node = $this->head;
        while ($node !== null && $node->value() !== $value) {
            $node = $node->next();
        }
        return $node;
    }

}
