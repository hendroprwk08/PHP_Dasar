<?php 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'db_HRD';
$dbcharset = 'utf8';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) 
    die('Gagal menghubungkan: ' . $mysqli->connect_error);

$mysqli->set_charset($dbcharset);
?>