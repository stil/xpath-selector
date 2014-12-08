<?php
namespace XPathSelector;

class NodeList implements \IteratorAggregate, \Countable, NodeListInterface
{
    protected $childNodes = [];
    protected $xpath;
    protected $length;

    public function __construct($search, $xpath, $domNodeList)
    {
        $this->xpath = $xpath;
        foreach ($domNodeList as $domNode) {
            $this->childNodes[] = new Node($domNode, $xpath);
        }
        $this->length = count($this->childNodes);
    }

    public function count()
    {
        return $this->length;
    }
    
    public function item($index)
    {
        if (isset($this->childNodes[$index])) {
            return $this->childNodes[$index];
        } else {
            throw new \OutOfBoundsException("Node with index $index does not exist in query results.");
        }
    }
    
    public function getIterator()
    {
        return new \ArrayIterator($this->childNodes);
    }

    public function each(callable $callback)
    {
        foreach ($this->childNodes as $index => $node) {
            $callback($node, $index);
        }
    }

    public function map(callable $callback)
    {
        $result = [];
        foreach ($this->childNodes as $index => $node) {
            $result[] = $callback($node, $index);
        }
        return $result;
    }
}
