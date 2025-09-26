<?php declare(strict_types = 1);

namespace Jade;

use Exception;
use InvalidArgumentException;

class SortedLinkedList
{

    private ?Node $head = null;

    public function __toString(): string
    {
        if ($this->head === null) {
            return 'Empty List';
        }

        $n = $this->head;
        while ( $n->next() !== null) {
            echo $n->getValue() . ' ';
            $n = $n->next();
        }
        echo $n->getValue() . ' ';
        return '';
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
    public function add(Node $new): void
    {
        if ($this->head === null) {
            $this->head = $new;
            return;
        }

        if ($this->head::class !== $new::class) {
            throw new InvalidArgumentException('Cannot add a ' . $new::class . ' node to a ' . $this->head::class . ' list.');
        }

        $precedent = $this->findPrecedent($new);
        if ($precedent === null) {
            $this->head->prepend($new);
            $this->head = $new;
        } else {
            $precedent->append($new);
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
            $array[] = $pointer->getValue();
            $pointer = $pointer->next();
        }
         return $array;
    }

}
