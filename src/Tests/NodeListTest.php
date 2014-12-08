<?php
namespace XPathSelector\Tests;

use XPathSelector\Node;
use XPathSelector\Selector;
use XPathSelector\Exception;

class NodeListTest extends TestCase
{
    /**
     * @var Selector
     */
    protected $xs;

    public function __construct()
    {
        $this->xs = Selector::loadHTMLFile(__DIR__.'/Resources/test.html');
    }

    public function testCount()
    {
        $divs = $this->xs->findAll('//div');
        $this->assertCount(160, $divs);
        $this->assertEquals(160, $divs->count());
    }

    public function testItem()
    {
        $divs = $this->xs->findAll('//div');

        $this->assertInstanceOf("XPathSelector\\Node", $divs->item(150));

        $ex = false;
        try {
            $divs->item(99999);
        } catch (\OutOfBoundsException $e) {
            $ex = true;
        }
        $this->assertTrue($ex);
    }

    public function testMap()
    {
        $langs = $this->xs->findAll('//select[@id="changelang-langs"]/option');
        $str = implode(', ', $langs->map(function (Node $node) {
            return $node->extract();
        }));

        $this->assertEquals(
            'English, Brazilian Portuguese, Chinese (Simplified), French, German, '.
            'Italian, Japanese, Romanian, Russian, Spanish, Turkish, Other',
            $str
        );
    }

    public function testEach()
    {
        $langs = $this->xs->findAll('//select[@id="changelang-langs"]/option');

        $str = [];
        $langs->each(function (Node $node) use (&$str) {
            $str[] = $node->extract();
        });

        $this->assertEquals(
            'English, Brazilian Portuguese, Chinese (Simplified), French, German, '.
            'Italian, Japanese, Romanian, Russian, Spanish, Turkish, Other',
            implode(', ', $str)
        );
    }
}
