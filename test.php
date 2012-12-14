<?php
require __DIR__.'/vendor/autoload.php';

    $xs = XPathSelector\Document::loadHTMLFile('http://www.orientcinemas.com.br/programacao/cinema.php?cod=5');
    $table = $xs->select('//*[@id="borda_bai"][1]');
    $result = array();
    $row = 0;
    foreach ($table->select('tr[position()>1]') as $tr) {
        $row++;
        $column = 0;
        foreach ($tr->select('td') as $td) {
            $column++;
            $result[$row][$column] = $td->extract();
        }
    }


print_r($result);