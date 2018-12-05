<?php
if($_GET['action'] == 'add'){
  $title = 'Ajouter une slide';
  if(isset($_POST['submit'])){
    $sql = $bdd->prepare("INSERT INTO slides (name, text, image, owner) VALUES(?, ?, ?, ?)");
    if($sql->execute(array($_POST['name'], $_POST['text'], $_POST['image'], $account['id']))){
      $error = '<div class="alert alert-success">La slide a bien été ajoutée !</div>';
      $_GET['action'] = 'view';
    }else{
      $error = '<div class="alert alert-danger">Une erreur est survenue lors de l\'ajout de la slide !</div>';
    }
  }
}
if($_GET['action'] == 'edit' && isset($_GET['id'])){
  $title = 'Modifier une slide';
  if(isset($_POST['submit'])){
    $sql = $bdd->prepare("UPDATE slides SET name = ?, text = ?, image = ? WHERE id = ?");
    if($sql->execute(array($_POST['name'], $_POST['text'], $_POST['image'], $_GET['id']))){
      $error = '<div class="alert alert-success">La slide a bien été modifiée !</div>';
      $_GET['action'] = 'view';
    }else{
      $error = '<div class="alert alert-danger">Une erreur est survenue lors de la modification de la slide !</div>';
    }
  }
}
if($_GET['action'] == 'delete' && isset($_GET['id'])){
  $title = 'Supprimer une slide';
  $sql = $bdd->prepare("DELETE FROM slides WHERE id = ?".($account['admin'] ? "" : " AND owner = ".$account['id']));
  if($sql->execute(array($_GET['id']))){
    $error = '<div class="alert alert-success">La slide a bien été supprimée !</div>';
    $_GET['action'] = 'view';
  }else{
    $error = '<div class="alert alert-danger">Une erreur est survenue lors de la suppression de la slide !</div>';
  }
}
if($_GET['action'] == 'view'){
  $title = 'Slides';
}
?>
