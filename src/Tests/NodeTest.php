<?php
namespace XPathSelector\Tests;

use XPathSelector\Selector;
use XPathSelector\Exception;

class NodeTest extends TestCase
{
    /**
     * @var Selector
     */
    protected $htmlSelector;

    /**
     * @var Selector
     */
    protected $xmlSelector;

    public function __construct()
    {
        $this->htmlSelector = Selector::loadHTMLFile(__DIR__.'/Resources/test.html');
    }

    public function testGetDOMNode()
    {
        $xs = $this->htmlSelector;
        $this->assertInstanceOf('DOMNode', $xs->getDOMNode());
    }

    public function testGetDOMXPath()
    {
        $xs = $this->htmlSelector;
        $this->assertInstanceOf('DOMXPath', $xs->getDOMXPath());
    }

    public function testInnerHtml()
    {
        $xmlPath = __DIR__.'/Resources/test.xml';
        $xs = Selector::load($xmlPath);
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

    public function testFind()
    {
        $xs = $this->htmlSelector;

        $exception = false;
        try {
            $xs->find('//titl')->extract();
        } catch (Exception\NodeNotFoundException $e) {
            $exception = true;
        }
        $this->assertTrue($exception);

        $exception = false;
        try {
            $xs->find('//////')->extract();
        } catch (Exception\XPathException $e) {
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

    public function testFindOneOrNull()
    {
        $xs = $this->htmlSelector;
        $this->assertNull($xs->findOneOrNull('//title[15]'));
    }
}
