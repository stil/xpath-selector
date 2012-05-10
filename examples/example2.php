<?php
require __DIR__.'/autoload.php';

$xs = \XPathSelector\Document::loadXMLFile(__DIR__.'/sample.xml');

# Extract all titles
foreach ($xs->select('/bookstore/book/title') as $title) {
	echo $title->extract();
	echo PHP_EOL;
}