#XPathSelector
##Description
XPathSelector is a libary created for HTML webscraping. It was inspired by Python's Scrapy.
It uses PHP DOM extension, so make sure you have it installed. PHP 5.4 is minimum.

##Installation
Recommended way to install XPathSelector is through [Composer](http://getcomposer.org/).
```json
{
    "require": {
        "stil/xpath-selector": "*"
    }
}
```

###Introduction
The starting point of all searches is `XPathSelector\Selector` class. It allows you to load HTML or XML, so you can process it then. There are several methods to do it:
```php
use XPathSelector\Selector;
$xs = Selector::load($pathToXml);
$xs = Selector::loadHTMLFile($pathToHtml);
$xs = Selector::loadXML($xmlString);
$xs = Selector::loadHTML($htmlString);
```

Next thing you want to do, is to decide whether you're searching for single DOM element or multiple elements.
For single search use `find($query)` method.
```php
use XPathSelector\Exception\NodeNotFoundException;

try {
	$element = $xs->find('//head'); // returns first <head> element found
	echo $element->innerHTML(); // print innerHTML of <head> tag
} catch (NodeNotFoundException $e) {
	echo $e->getMessage(); // nothing have been found
}
```
And if you need multiple results, use `findAll($query)` instead. This method returns instance of `XPathSelector\NodeListInterface`. Check it out in the API.
```php
use XPathSelector\Selector;

$urls = $xs->findAll('//a/@href');
foreach ($urls as $url) {
	echo $url;
}
```

Do you need to check whether XPath path exists? Use `findOneOrNull($query)` method. It returns `Node` object or null, when no results were found. It works just like `find($query)`, except it returns null instead of throwing exception.
```php
use XPathSelector\Selector;

$doesExist = $xs->findOneOrNull('//a/@href') !== null;
```

###sample.xml
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
###Search for single result
```php
<?php
use XPathSelector\Selector;
$xs = Selector::load('sample.xml');

echo $xs->find('/bookstore/book[1]/title');
```
Result:
```
Everyday Italian
```
###Search for multiple results
```php
<?php
use XPathSelector\Selector;
$xs = Selector::load('sample.xml');

foreach ($xs->findAll('/bookstore/book') as $book) {
	printf(
		"[Title: %s][Price: %s]\n",
		$book->find('title')->extract(),
		$book->find('price')->extract()
	);
}
```
Result:
```
[Title: Everyday Italian][Price: 30.00]
[Title: Harry Potter][Price: 29.99]
[Title: XQuery Kick Start][Price: 49.99]
[Title: Learning XML][Price: 39.95]
```
###Map result set to array
```php
<?php
use XPathSelector\Selector;
$xs = Selector::load('sample.xml');

$array = $xs->findAll('/bookstore/book')->map(function ($node, $index) {
	return [
		'index' => $index,
		'title' => $node->find('title')->extract(),
		'price' => (float)$node->find('price')->extract()
	];
});

var_dump($array);
```
Result:
```
array(4) {
  [0] =>
  array(3) {
    'index' =>
    int(0)
    'title' =>
    string(16) "Everyday Italian"
    'price' =>
    double(30)
  }
  [1] =>
  array(3) {
    'index' =>
    int(1)
    'title' =>
    string(12) "Harry Potter"
    'price' =>
    double(29.99)
  }
  [2] =>
  array(3) {
    'index' =>
    int(2)
    'title' =>
    string(17) "XQuery Kick Start"
    'price' =>
    double(49.99)
  }
  [3] =>
  array(3) {
    'index' =>
    int(3)
    'title' =>
    string(12) "Learning XML"
    'price' =>
    double(39.95)
  }
}
```
