<?php
namespace XPathSelector\Tests;

use XPathSelector\Selector;

class SelectorTest extends TestCase
{
    public function testLoad()
    {
        $selector = Selector::load(__DIR__.'/Resources/test.xml');
        $this->assertInstanceOf('XPathSelector\Selector', $selector);
    }

    public function testLoadXML()
    {
        $xml = file_get_contents(__DIR__.'/Resources/test.xml');
        $selector = Selector::loadXML($xml);
        $this->assertInstanceOf('XPathSelector\Selector', $selector);
    }

    public function testLoadHTMLFile()
    {
        $selector = Selector::loadHTMLFile(__DIR__.'/Resources/test.html');
        $this->assertInstanceOf('XPathSelector\Selector', $selector);
    }

    public function testLoadHTML()
    {
        $html = file_get_contents(__DIR__.'/Resources/test.html');
        $selector = Selector::loadHTML($html);
        $this->assertInstanceOf('XPathSelector\Selector', $selector);
    }
}
