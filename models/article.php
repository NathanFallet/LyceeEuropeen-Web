<?php
if(isset($_GET['id'])){
  $sql = $bdd->prepare("SELECT * FROM articles WHERE id = ?");
  $sql->execute(array($_GET['id']));
  $dn = $sql->fetch();
  if(!$dn){
    unset($dn);
  }
}
if(isset($dn)){
  $title = $dn['title'];
}else{
  $title = 'Nos articles';
}
?>
