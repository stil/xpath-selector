<?php
namespace XPathSelector\Tests;

use XPathSelector;

class MainTest extends TestCase
{
    public function testDocument()
    {
        $hxs = XPathSelector\Document::loadXMLFile(__DIR__.'/Resources/test1.xml');
        $this->assertInstanceOf('\XPathSelector\Node', $hxs);
        
        $xml = file_get_contents(__DIR__.'/Resources/test1.xml');
        $hxs = XPathSelector\Document::loadXML($xml);
        $this->assertInstanceOf('\XPathSelector\Node', $hxs);
        
        $hxs = XPathSelector\Document::loadHTMLFile(__DIR__.'/Resources/test1.html');
        $this->assertInstanceOf('\XPathSelector\Node', $hxs);
        
        $html = file_get_contents(__DIR__.'/Resources/test1.html');
        $hxs = XPathSelector\Document::loadXML($html);
        $this->assertInstanceOf('\XPathSelector\Node', $hxs);
    }
    
    public function testSelect()
    {
        $hxs = XPathSelector\Document::loadXMLFile(__DIR__.'/Resources/test2.xml');
        
        $nodes = $hxs->select('/bookstore/book[1]/title');
        $this->assertInstanceOf('\XPathSelector\NodeList', $nodes);
        $this->assertTrue($nodes->hasResults());
        $this->assertEquals(1, $nodes->count());
        $this->assertEquals('Everyday Italian', $nodes->extract());
        $this->assertEquals('Everyday Italian', (string)$nodes);
        
        $nodes = $hxs->select('/bookstore/book[100]/title');
        $this->assertInstanceOf('\XPathSelector\NodeList', $nodes);
        $this->assertFalse($nodes->hasResults());
        $this->assertEquals(0, $nodes->count());
        
        $e = null;
        try {
            $nodes->extract();
        } catch (\Exception $e) {
        }
        $this->assertInstanceOf('\XPathSelector\Exception\EmptyResultException', $e);
        
        $nodes = $hxs->select('/bookstore/book/title');
        $this->assertInstanceOf('\XPathSelector\NodeList', $nodes);
        $this->assertTrue($nodes->hasResults());
        $this->assertEquals(4, $nodes->count());
        
        foreach ($nodes as $node) {
            $this->assertInstanceOf('\XPathSelector\Node', $node);
            $this->assertInternalType('string', $node->extract());
            $this->assertInternalType('string', (string)$node);
        }
    }
}
