<?php
namespace XPathSelector;

use XPathSelector\Exception\NodeNotFoundException;
use XPathSelector\Exception\XPathException;
use DOMXPath;
use DOMDocument;
use DOMNode;

class Node implements NodeInterface
{
    /**
     * @var DOMXPath
     */
    protected $xpath;

    public function __construct(DOMNode $node, $xpath = null)
    {
        $this->node = $node;

        if ($node instanceof DOMDocument) {
            $this->xpath = new DOMXPath($node);
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

    protected function internalQuery($query)
    {
        $nodeList = @$this->xpath->query($query, $this->node);
        if ($nodeList == false) {
            throw new XPathException("Invalid expression $query");
        } else {
            return $nodeList;
        }
    }
    
    public function find($query)
    {
        $nodeList = $this->internalQuery($query);
        if ($nodeList->length == 0) {
            throw new NodeNotFoundException("Query $query returned no results");
        }
        return new Node($nodeList->item(0), $this->xpath);
    }

    public function findOneOrNull($query)
    {
        try {
            return $this->find($query);
        } catch (NodeNotFoundException $e) {
            return null;
        }
    }

    public function findAll($query)
    {
        return new NodeList(
            $query,
            $this->xpath,
            $this->internalQuery($query)
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
        if ($this->node instanceof DOMDocument) {
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
        if ($this->node instanceof DOMDocument) {
            return $this->node->saveHTML();
        } else {
            return $this->node->ownerDocument->saveHTML($this->node);
        }
    }
}
