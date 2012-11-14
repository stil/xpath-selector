<?php
namespace XPathSelector;
use DOMXPath;

class Node
{
    protected $node;
    protected $xpath;
    
    public function __construct($node, DOMXPath $xpath)
    {
        $this->node = $node;
        $this->xpath = $xpath;
    }
    
    public function registerNamespace($prefix, $namespaceURI)
    {
        $this->xpath->registerNamespace($prefix, $namespaceURI);
    }
    
    public function select($search)
    {
        return new NodeList(
            $search,
            $this->xpath,
            $this->xpath->query($search, $this->node)
        );
    }
    
    public function extract()
    {
        return $this->node->nodeValue;
    }
    
    public function __toString()
    {
        return $this->node->nodeValue;
    }
}
