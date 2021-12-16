<?php

/*
$host = "mysql57.webtaro.sakura.ne.jp";
$dbname = "webtaro_toeic";
$dbuser = "webtaro";
$dbpass = "paginawebtapo13";
*/
$host = "localhost";
$dbname = "toeic";
$dbuser = "root";
$dbpass = "";


$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
$pdo = new PDO($dsn, $dbuser, $dbpass);

define("WEB_TITLE", "Language Bootcamp");





?>