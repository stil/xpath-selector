<?php
namespace XPathSelector;

interface NodeListInterface
{
    /**
     * Returns amount of child nodes
     * @return int
     */
    public function count();

    /**
     * Returns node by given index
     * @param  int $index Zero starting index of element
     * @throws \OutOfBoundsException
     * @return Node
     */
    public function item($index);

    /**
     * Executes provided function for each element in list.
     * @param  callable $callback
     * @return void
     */
    public function each(callable $callback);

    /**
     * Creates a new array with the results of calling
     * a provided function on every element in this node list
     * @param  callable $callback
     * @return array
     */
    public function map(callable $callback);
}
