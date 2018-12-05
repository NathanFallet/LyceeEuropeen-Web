<?php
if($_GET['action'] == 'add'){
  $title = 'Ajouter un article';
  if(isset($_POST['submit'])){
    $sql = $bdd->prepare("INSERT INTO articles (title, content, image, publish, owner) VALUES(?, ?, ?, NOW(), ?)");
    if($sql->execute(array($_POST['title'], $_POST['content'], $_POST['image'], $account['id']))){
      $error = '<div class="alert alert-success">L\'article a bien été ajouté !</div>';
      $_GET['action'] = 'view';
    }else{
      $error = '<div class="alert alert-danger">Une erreur est survenue lors de l\'ajout de l\'article !</div>';
    }
  }
}
if($_GET['action'] == 'edit' && isset($_GET['id'])){
  $title = 'Modifier un article';
  if(isset($_POST['submit'])){
    $sql = $bdd->prepare("UPDATE articles SET title = ?, content = ?, image = ? WHERE id = ?".($account['admin'] ? "" : " AND owner = ".$account['id']));
    if($sql->execute(array($_POST['title'], $_POST['content'], $_POST['image'], $_GET['id']))){
      $error = '<div class="alert alert-success">L\'article a bien été modifié !</div>';
      $_GET['action'] = 'view';
    }else{
      $error = '<div class="alert alert-danger">Une erreur est survenue lors de la modification de l\'article !</div>';
    }
  }
}
if($_GET['action'] == 'delete' && isset($_GET['id'])){
  $title = 'Supprimer un article';
  $sql = $bdd->prepare("DELETE FROM articles WHERE id = ?".($account['admin'] ? "" : " AND owner = ".$account['id']));
  if($sql->execute(array($_GET['id']))){
    $error = '<div class="alert alert-success">L\'article a bien été supprimé !</div>';
    $_GET['action'] = 'view';
  }else{
    $error = '<div class="alert alert-danger">Une erreur est survenue lors de la suppression de l\'article !</div>';
  }
}
if($_GET['action'] == 'view'){
  $title = 'Articles';
}
?>
