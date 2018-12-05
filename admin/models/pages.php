<?php
if($_GET['action'] == 'add'){
  $title = 'Ajouter une page';
  if(isset($_POST['submit'])){
    $sql = $bdd->prepare("INSERT INTO pages (name, text, owner) VALUES(?, ?, ?)");
    if($sql->execute(array($_POST['name'], $_POST['text'], $account['id']))){
      $error = '<div class="alert alert-success">La page a bien été ajoutée !</div>';
      $_GET['action'] = 'view';
    }else{
      $error = '<div class="alert alert-danger">Une erreur est survenue lors de l\'ajout de la page !</div>';
    }
  }
}
if($_GET['action'] == 'edit' && isset($_GET['id'])){
  $title = 'Modifier une page';
  if(isset($_POST['submit'])){
    $sql = $bdd->prepare("UPDATE pages SET name = ?, text = ? WHERE id = ?".($account['admin'] ? "" : " AND owner = ".$account['id']));
    if($sql->execute(array($_POST['name'], $_POST['text'], $_GET['id']))){
      $error = '<div class="alert alert-success">La page a bien été modifiée !</div>';
      $_GET['action'] = 'view';
    }else{
      $error = '<div class="alert alert-danger">Une erreur est survenue lors de la modification de la page !</div>';
    }
  }
}
if($_GET['action'] == 'delete' && isset($_GET['id'])){
  $title = 'Supprimer une page';
  $sql = $bdd->prepare("DELETE FROM pages WHERE id = ?".($account['admin'] ? "" : " AND owner = ".$account['id']));
  if($sql->execute(array($_GET['id']))){
    $error = '<div class="alert alert-success">La page a bien été supprimée !</div>';
    $_GET['action'] = 'view';
  }else{
    $error = '<div class="alert alert-danger">Une erreur est survenue lors de la suppression de la page !</div>';
  }
}
if($_GET['action'] == 'view'){
  $title = 'Pages';
}
?>
