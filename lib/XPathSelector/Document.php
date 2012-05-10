<?php
namespace XPathSelector;
use DOMXPath;
use DOMDocument;

class Document {
	
	protected static function load($doc) {
		$xpath = new DOMXPath($doc);
		return new Node($doc,$xpath);
	}
	
	public static function loadHTMLFile($filename) {
		$doc = @DOMDocument::loadHTMLFile($filename);
		return self::load($doc);
	}
	
	public static function loadHTML($html) {
		$doc = @DOMDocument::loadHTML($html);
		return self::load($doc);
	}
	
	public static function loadXML($xml) {
		$doc = DOMDocument::loadXML($xml);
		return self::load($doc);
	}
	
	public static function loadXMLFile($filename) {
		$doc = DOMDocument::load($filename);
		return self::load($doc);
	}
}