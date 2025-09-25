<?php

namespace Jade;

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