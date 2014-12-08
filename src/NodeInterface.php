<?php
namespace XPathSelector;

interface NodeInterface
{
    /**
     * Returns original DOMNode object
     * @return \DOMNode
     */
    public function getDOMNode();

    /**
     * Returns original DOMXPath object hooked to DOMDocument
     * @return \DOMXPath
     */
    public function getDOMXPath();

    /**
     * Returns text content of node
     * @return string
     */
    public function extract();

    /**
     * Returns text content of node
     * @return string
     */
    public function __toString();

    /**
     * Returns markup of the element's content
     * @return string
     */
    public function innerHTML();

    /**
     * Returns markup of the element including its content
     * @return string
     */
    public function outerHTML();

    /**
     * Performs search on given query, returns first result
     * @param  string   $query                  XPath query
     * @return Node                             Node object
     * @throws Exception\NodeNotFoundException  If query returned no results
     * @throws Exception\XPathException         If query was malformed
     */
    public function find($query);

    /**
     * Performs search on given query, returns first result or null
     * @param  string   $query                  XPath query
     * @return Node|null                        Node object or null when no results found
     * @throws Exception\XPathException         If query was malformed
     */
    public function findOneOrNull($query);

    /**
     * Performs search on given query, returns results list
     * @param  string   $query                  XPath query
     * @return NodeNodeList                     Nodes list
     * @throws Exception\NodeNotFoundException  If query returned no results
     * @throws Exception\XPathException         If query was malformed
     */
    public function findAll($query);
}
