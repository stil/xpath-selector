<?php
namespace XPathSelector\Tests;

use XPathSelector\Selector;
use XPathSelector\Exception;

class NodeListTest extends TestCase
{
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

    public function testMap()
    {
        $langs = $this->xs->findAll('//select[@id="changelang-langs"]/option');
        $str = implode(', ', $langs->map(function ($node) {
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
        $langs->each(function ($node) use (&$str) {
            $str[] = $node->extract();
        });

        $this->assertEquals(
            'English, Brazilian Portuguese, Chinese (Simplified), French, German, '.
            'Italian, Japanese, Romanian, Russian, Spanish, Turkish, Other',
            implode(', ', $str)
        );
    }
}
