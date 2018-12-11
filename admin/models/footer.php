<?php
$json = file_get_contents('../footer.json');
$footer = json_decode($json, true);

if(isset($_POST['submit'])) {
  $footer['address'] = $_POST['address'];
  $footer['phone'] = $_POST['phone'];
  $footer['mail'] = $_POST['mail'];
  $footer['facebook'] = $_POST['facebook'];
  file_put_contents('../footer.json', json_encode($footer));
}
