<?php
namespace XPathSelector;

use Iterator;
use Countable;

class NodeList implements Iterator, Countable
{
    protected $search = array();
    protected $result;
    protected $xpath;
    protected $length;

    public function __construct($search, $xpath, $nodeList)
    {
        $this->search = $search;
        $this->xpath = $xpath;
        foreach ($nodeList as $node) {
            $this->result[] = new Node($node, $this->xpath);
        }
        $this->length = count($this->result);
    }
    
    public function registerNamespace($prefix, $namespaceURI)
    {
        $this->xpath->registerNamespace($prefix, $namespaceURI);
    }
    
    public function item($n)
    {
        if (isset($this->result[$n])) {
            return $this->result[$n];
        } else {
            return null;
        }
    }
    
    public function rewind()
    {
        if (!$this->hasResults()) {
            throw new Exception\EmptyResultException(
                'XPath error: '.$this->search.' not found.'
            );
        }
        reset($this->result);
    }

    public function current()
    {
        return current($this->result);
    }

    public function key()
    {
        return key($this->result);
    }

    public function next()
    {
        next($this->result);
    }

    public function valid()
    {
        $pos=key($this->result);
        return isset($this->result[$pos]);
    }
    
    public function count()
    {
        return $this->length;
    }
    
    public function hasResults()
    {
        return $this->length > 0;
    }
    
    public function select($search)
    {
        $firstItem = $this->item(0);
        if ($firstItem) {
            return $firstItem->select($search);
        } else {
            throw new EmptyResultException(
                'XPath error: '.$this->search.' not found.'
            );
        }
    }
    
    public function extract()
    {
        $firstItem = $this->item(0);
        if ($firstItem) {
            return $firstItem->extract();
        } else {
            throw new Exception\EmptyResultException(
                'XPath error: '.$this->search.' not found.'
            );
        }
    }
    
    public function __toString()
    {
        return $this->extract();
    }
}
