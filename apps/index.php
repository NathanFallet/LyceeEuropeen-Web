<?php
require '../config.php';

$data = json_decode(file_get_contents('php://input'), true);

// TODO: Tester les methodes et retourner les donnees correspondantes
if($data['method'] == 'getPosts'){
  $response = array(array('text' => 'My beautiful post loaded by PHP on API Server (c\'est ici que PHP va load depuis la BDD)'));
  echo json_encode($response);
}
