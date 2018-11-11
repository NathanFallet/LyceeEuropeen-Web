<?php
if(!isset($_GET['id'])){
  header('location: '.$url);
  exit;
}
$sql = $bdd->prepare("SELECT * FROM pages WHERE id = ?");
$sql->execute(array($_GET['id']));
$dn = $sql->fetch();
if(!$dn){
  header('location: '.$url);
  exit;
}
$title = $dn['name'];
?>
