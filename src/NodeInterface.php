<?php
namespace XPathSelector;

interface NodeInterface
{
    /**
     * Returns original DOMNode object
     * @return DOMNode
     */
    public function getDOMNode();

    /**
     * Returns original DOMXPath object hooked to DOMDocument
     * @return DOMXPath
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
     * @param  string $search XPath query
     * @return Node           Node object
     * @throws Exception\NotFoundException If query returned no results
     */
    public function find($query);

    /**
     * Performs search on given query, returns results list
     * @param  string $search XPath query
     * @return Node           Node object
     * @throws Exception\NotFoundException If query returned no results
     */
    public function findAll($query);
}
