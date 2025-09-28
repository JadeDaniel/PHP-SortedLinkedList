# SortedLinkedList

This simple library offers a sorted linked list.
You can either add Int values or String values, but not both. 
An InvalidArgumentException will be thrown if values are mixed.

# Usage
A new sorted linked list can be created and new int or string nodes added as follows
```
$list = new SortedLinkedList()
$list->add(new IntNode(10)) OR $list->add(new StringNode("Hello!"))
```

For convenience, this can be shortened to passing the simple scalar values for a new node:
```
$list = new SortedLinkedList()
$list->add(10) OR $list->add("Hello!")
```

These two lines can be made even shorter by passing the initial scalar values to the SortedLinkedList constructor:
```
$list = new SortedLinkedList([10, 1500]) OR $list = new SortedLinkedList(["Hello", "World"])
```

Note that string and int types cannot be mixed in a single list. An exception will be thrown. 


# Checks
Run `./check.sh` to lint, perform static analysis, and run the test suite