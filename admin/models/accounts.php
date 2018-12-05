<?php
if($_GET['action'] == 'add'){
  $title = 'Ajouter un compte';
  if(isset($_POST['submit'])){
    if(md5($_POST['password']) == md5($_POST['password2'])){
      $sql = $bdd->prepare("INSERT INTO accounts (username, password, slides, pages, articles, uploads, admin) VALUES(?, ?, ?, ?, ?, ?, ?)");
      if($sql->execute(array($_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), isset($_POST['slides']) ? 1 : 0,
          isset($_POST['pages']) ? 1 : 0, isset($_POST['articles']) ? 1 : 0, isset($_POST['uploads']) ? 1 : 0, isset($_POST['admin']) ? 1 : 0))){
        $error = '<div class="alert alert-success">Le compte a bien été ajouté !</div>';
        $_GET['action'] = 'view';
      }else{
        $error = '<div class="alert alert-danger">Une erreur est survenue lors de l\'ajout du compte !</div>';
      }
    }else{
      $error = '<div class="alert alert-danger">Les mots de passe ne correspondent pas !</div>';
    }
  }
}
if($_GET['action'] == 'delete' && isset($_GET['id'])){
  $title = 'Supprimer un compte';
  $sql = $bdd->prepare("DELETE FROM accounts WHERE id = ?");
  if($sql->execute(array($_GET['id']))){
    $error = '<div class="alert alert-success">Le compte a bien été supprimé !</div>';
    $_GET['action'] = 'view';
  }else{
    $error = '<div class="alert alert-danger">Une erreur est survenue lors de la suppression du compte !</div>';
  }
}
if($_GET['action'] == 'view'){
  $title = 'Comptes';
}
?>
