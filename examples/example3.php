<?php
require __DIR__.'/autoload.php';

$xs = \XPathSelector\Document::loadXMLFile(__DIR__.'/sample.xml');


# Extract all the prices
foreach ($xs->select('/bookstore/book/price') as $price) {
	echo $price->extract();
    echo PHP_EOL;
}

echo '----------'.PHP_EOL;

# Extract price nodes with price>35
foreach ($xs->select('/bookstore/book[price>35]/price') as $price) {
	echo $price->extract();
    echo PHP_EOL;
}
