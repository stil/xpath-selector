<?php
namespace XPathSelector;

class Node implements NodeInterface
{
    protected $xpath;

    public function __construct(\DOMNode $node, $xpath = null)
    {
        $this->node = $node;

        if ($node instanceof \DOMDocument) {
            $this->xpath = new \DOMXPath($node);
        } else {
            $this->xpath = $xpath;
        }
    }

    public function getDOMNode()
    {
        return $this->node;
    }

    public function getDOMXPath()
    {
        return $this->xpath;
    }
    
    public function find($query)
    {
        $nodeList = $this->xpath->query($query, $this->node);
        if ($nodeList->length == 0) {
            throw new Exception\NotFoundException("Query $query returned no results");
        }
        return new Node($nodeList->item(0), $this->xpath);
    }

    public function findAll($query)
    {
        return new NodeList(
            $query,
            $this->xpath,
            $this->xpath->query($query, $this->node)
        );
    }

    public function extract()
    {
        return $this->node->nodeValue;
    }

    public function __toString()
    {
        return $this->extract();
    }

    public function innerHTML()
    {
        if ($this->node instanceof \DOMDocument) {
            $doc = $this->node;
        } else {
            $doc = $this->node->ownerDocument;
        }

        $innerHTML = '';
        foreach ($this->node->childNodes as $child) {
            $innerHTML .= $doc->saveHTML($child);
        }

        return $innerHTML;
    }

    public function outerHTML()
    {
        if ($this->node instanceof \DOMDocument) {
            return $this->node->saveHTML();
        } else {
            return $this->node->ownerDocument->saveHTML($this->node);
        }
    }
}
