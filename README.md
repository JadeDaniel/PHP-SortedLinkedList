# SortedLinkedList
[![Build & Test on push](https://github.com/JadeDaniel/PHP-SortedLinkedList/actions/workflows/build_and_test.yml/badge.svg?branch=master)](https://github.com/JadeDaniel/PHP-SortedLinkedList/actions/workflows/build_and_test.yml)

This simple library offers a sorted linked list.
You can either add Int values or String values, but not both. 
An InvalidArgumentException will be thrown if values are mixed.

# Usage
A new sorted linked list can be created and new int or string nodes added as follows
```
$list = new SortedLinkedList();
$list->add(new IntNode(10));
$list->add(new IntNode(12));

// The IntNode constructor can be called implicitly
$list->add(6);
$list->add(4);

echo $list;
// prints: 4, 6, 10, 12

// Initial int nodes can be created in the constructor
$list2 = new SortedLinkedList( [500, 1200, 3, 15] );
```

```
// String nodes can be used instead
$list = new SortedLinkedList();
$list->add(new StringNode("Zebra")); 

$list->add("Apple");

$list2 = new SortedLinkedList( ["Car", "Yoyo"] );

```

Note that string and int types cannot be mixed in a single list. An exception will be thrown. 


# Checks
Run `./check.sh` to lint, perform static analysis, and run the test suite