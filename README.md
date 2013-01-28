#XPathSelector
##Description
This is simple utlitity which helps you navigate in HTML or XML document.
It was inspired by Python's Scrapy. XPathSelector uses PHP DOM extension.
##Installation
Recommended way to install XPathSelector is through [Composer](http://getcomposer.org/).
```json
{
    "require": {
        "stil/xpath-selector": "*"
    }
}
```
##Example XML document
```xml
<?xml version="1.0" encoding="ISO-8859-1" ?>
<bookstore>
	<book category="COOKING">
		<title lang="en">Everyday Italian</title>
		<author>Giada De Laurentiis</author>
		<year>2005</year>
		<price>30.00</price>
	</book>
	<book category="CHILDREN">
		<title lang="en">Harry Potter</title>
		<author>J K. Rowling</author>
		<year>2005</year>
		<price>29.99</price>
	</book>
	<book category="WEB">
		<title lang="en">XQuery Kick Start</title>
		<author>James McGovern</author>
		<author>Per Bothner</author>
		<author>Kurt Cagle</author>
		<author>James Linn</author>
		<author>Vaidyanathan Nagarajan</author>
		<year>2003</year>
		<price>49.99</price>
	</book>
	<book category="WEB">
		<title lang="en">Learning XML</title>
		<author>Erik T. Ray</author>
		<year>2003</year>
		<price>39.95</price>
	</book>
</bookstore>
```
###Extract first title of the book
```php
<?php
$xs = \XPathSelector\Document::loadXMLFile('sample.xml');
$firstBook = $xs->select('/bookstore/book[1]');
echo $firstBook->select('title')->extract();
// or directly
//echo $xs->select('/bookstore/book[1]/title')->extract();
```
Result:
```
Everyday Italian
```
###Extract all titles with their prices
```php
<?php
$xs = \XPathSelector\Document::loadXMLFile('sample.xml');
foreach ($xs->select('/bookstore/book') as $book) {
	echo 'Title: '.$book->select('title')->extract();
	echo PHP_EOL;
	echo 'Price: '.$book->select('price')->extract();
	echo PHP_EOL;
}
```
Result:
```
[Title: Everyday Italian][Price: 30.00]
[Title: Harry Potter][Price: 29.99]
[Title: XQuery Kick Start][Price: 49.99]
[Title: Learning XML][Price: 39.95]
```
###Extract all the prices
```php
<?php
$xs = \XPathSelector\Document::loadXMLFile('sample.xml');
foreach ($xs->select('/bookstore/book/price') as $price) {
	echo $price->extract();
    echo PHP_EOL;
}
```
Result:
```
30.00
29.99
49.99
39.95
```
###Extract price nodes with price>35
```php
<?php
$xs = \XPathSelector\Document::loadXMLFile('sample.xml');
foreach ($xs->select('/bookstore/book[price>35]/price') as $price) {
	echo $price->extract();
    echo PHP_EOL;
}
```
Result:
```
49.99
39.95
```