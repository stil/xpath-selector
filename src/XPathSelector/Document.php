<?php
namespace XPathSelector;

use DOMXPath;
use DOMDocument;

class Document
{
    protected static function load($doc)
    {
        $xpath = new DOMXPath($doc);
        return new Node($doc, $xpath);
    }
    
    public static function loadHTMLFile($filename)
    {
        $doc = new DOMDocument;
        @$doc->loadHTMLFile($filename);
        return self::load($doc);
    }
    
    public static function loadHTML($html)
    {
        $doc = new DOMDocument;
        @$doc->loadHTML($html);
        return self::load($doc);
    }
    
    public static function loadXML($xml)
    {
        $doc = new DOMDocument;
        @$doc->loadXML($xml);
        return self::load($doc);
    }
    
    public static function loadXMLFile($filename)
    {
        $doc = new DOMDocument;
        @$doc->load($filename);
        return self::load($doc);
    }
}
