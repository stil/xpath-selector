<?php
namespace XPathSelector\Tests;

use XPathSelector\Selector;
use XPathSelector\Exception;

class NodeTest extends TestCase
{
    public function testTopNode()
    {
        $xmlPath = __DIR__.'/Resources/test.xml';
        $xs = Selector::load($xmlPath);
        
        $this->assertInstanceOf('DOMNode', $xs->getDOMNode());
        $this->assertInstanceOf('DOMXPath', $xs->getDOMXPath());
        $this->assertEquals($xs->innerHTML(), '<bookstore>
    <book category="COOKING">
        <title lang="en">Everyday Italian</title>
        <author>Giada De Laurentiis</author>
        <year>2005</year>
        <price>30.00</price>
    </book>
    <book category="CHILDREN">
        <title lang="en">Harry Potter</title>
        <author>J K. Rowling</author>
        <year>2005</year>
        <price>29.99</price>
    </book>
    <book category="WEB">
        <title lang="en">XQuery Kick Start</title>
        <author>James McGovern</author>
        <author>Per Bothner</author>
        <author>Kurt Cagle</author>
        <author>James Linn</author>
        <author>Vaidyanathan Nagarajan</author>
        <year>2003</year>
        <price>49.99</price>
    </book>
    <book category="WEB">
        <title lang="en">Learning XML</title>
        <author>Erik T. Ray</author>
        <year>2003</year>
        <price>39.95</price>
    </book>
</bookstore>');
    }

    public function testNode()
    {
        $xs = Selector::loadHTMLFile(__DIR__.'/Resources/test.html');

        $exception = false;
        try {
            $xs->find('//titl')->extract();
        } catch (Exception\NotFoundException $e) {
            $exception = true;
        }
        $this->assertTrue($exception);
        
        $this->assertEquals(
            'PHP: DOMNode - Manual ',
            $xs->find('//title')->extract()
        );

        $this->assertEquals(
            'PHP: DOMNode - Manual ',
            (string)$xs->find('//title')
        );

        $this->assertEquals(
            '<img src="/images/logo.php" width="48" height="24" alt="php">',
            $xs->find('//a[@class="brand"][1]')->innerHTML()
        );

        $this->assertEquals(
            '<a href="/" class="brand"><img src="/images/logo.php" width="48" height="24" alt="php"></a>',
            $xs->find('//a[@class="brand"][1]')->outerHTML()
        );
    }
}
