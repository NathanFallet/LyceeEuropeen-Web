<?php
require '../config.php';

$data = json_decode(file_get_contents('php://input'), true);

if($data['method'] == 'getArticles()'){
  $sql = $bdd->query("SELECT * FROM articles ORDER BY publish DESC");
  $response = $sql->fetchAll();
  $response['success'] = 'true';
  echo json_encode($response);
}else if($data['method'] == 'getPages()'){
  $sql = $bdd->query("SELECT * FROM pages");
  $response = $sql->fetchAll();
  $response['success'] = 'true';
  echo json_encode($response);
}else if($data['method'] == 'getSlides()'){
  $sql = $bdd->query("SELECT * FROM slides");
  $response = $sql->fetchAll();
  $response['success'] = 'true';
  echo json_encode($response);
}
