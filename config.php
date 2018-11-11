<?php
$url = 'http://localhost/lycee/';
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=lycee_europeen', 'lycee_europeen', 'lycee_europeen', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (Exception $e) {
  die($e->getMessage());
}
?>
