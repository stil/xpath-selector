<?php
namespace XPathSelector;

use DOMDocument;

class Selector extends Node
{
    public static function load($path)
    {
        return new self(DOMDocument::load($path));
    }

    public static function loadXML($xml)
    {
        return new self(DOMDocument::loadXML($xml));
    }

    public static function loadHTMLFile($html)
    {
        return new self(@DOMDocument::loadHTMLFile($html));
    }

    public static function loadHTML($path)
    {
        return new self(@DOMDocument::loadHTML($path));
    }
}
