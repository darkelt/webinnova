<?php
include_once 'psl-config.php';   // Ya que functions.php no est� incluido.
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
$stmt = $mysqli->query("SET NAMES 'utf8'");
?>