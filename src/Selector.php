<?php
namespace XPathSelector;

use DOMDocument;

class Selector extends Node
{
    public static function load($path)
    {
        $dom = new DOMDocument();
        @$dom->load($path);
        return new self($dom);
    }

    public static function loadXML($xml)
    {
        $dom = new DOMDocument();
        @$dom->loadXML($xml);
        return new self($dom);
    }

    public static function loadHTMLFile($html)
    {
        $dom = new DOMDocument();
        @$dom->loadHTMLFile($html);
        return new self($dom);
    }

    public static function loadHTML($path)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($path);
        return new self($dom);
    }
}
