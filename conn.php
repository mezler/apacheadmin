<?php


$config = require $_SERVER['DOCUMENT_ROOT'] .'/props.php';

$link = mysqli_connect($config['host'], $config['dbuser'], $config['dbpass'], $config['db']);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

$link->query("SET NAMES 'utf8'");
// mysqli_set_charset($link,"utf8");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
}