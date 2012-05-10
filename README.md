#XPathSelector
##Description
This is simple utlitity which helps you navigate in HTML or XML document.
It was inspired by Python's Scrapy. XPathSelector uses PHP DOM extension.
##Example XML document (sample.xml)
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
echo $xs->select('/bookstore/book[1]/title')->extract();
```
Result:
```
Everyday Italian
```
###Extract all titles
```php
<?php
$xs = \XPathSelector\Document::loadXMLFile('sample.xml');
foreach ($xs->select('/bookstore/book/title') as $title) {
	echo $title->extract();
	echo PHP_EOL;
}
```
Result:
```
Everyday Italian
Harry Potter
XQuery Kick Start
Learning XML
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