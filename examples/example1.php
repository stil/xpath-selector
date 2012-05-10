<?php
require __DIR__.'/autoload.php';

$xs = \XPathSelector\Document::loadXMLFile(__DIR__.'/sample.xml');

# Extract first title
echo $xs->select('/bookstore/book[1]/title')->extract();
