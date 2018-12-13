<?php
require '../config.php';

$data = json_decode(file_get_contents('php://input'), true);

if($data['method'] == 'getArticles()'){
  $sql = $bdd->prepare("SELECT * FROM articles ORDER BY publish DESC");
  $response = $sql->fetchAll();
  echo json_encode($response);
}else if($data['method'] == 'getPages()'){
  $sql = $bdd->prepare("SELECT * FROM pages");
  $response = $sql->fetchAll();
  echo json_encode($response);
}else if($data['method'] == 'getSlides()'){
  $sql = $bdd->prepare("SELECT * FROM slides");
  $response = $sql->fetchAll();
  echo json_encode($response);
}
