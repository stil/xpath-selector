<?php
namespace XPathSelector;
//use Erepublik\Exception\ScrapeException;
use DOMXPath;
use DOMDocument;

class Document {
	
	protected static function load($doc) {
		$xpath = new DOMXPath($doc);
		return new Node($doc,$xpath);
	}
	
	public static function loadHTML($html) {
		$doc = @DOMDocument::loadHTML($html);
		return self::load($doc);
	}
	
	public static function loadXML($xml) {
		$doc = DOMDocument::loadXML($xml);
		return self::load($doc);
	}
}