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
     * @param  int $index
     * @return mixed
     */
    public function item($index);

    /**
     * Executes provided function for each element in list
     * @param  callable $callback
     * @return array
     */
    public function each($callback);

    /**
     * Creates a new array with the results of calling
     * a provided function on every element in this node list
     * @param  callable $callback
     * @return array
     */
    public function map($callback);
}
