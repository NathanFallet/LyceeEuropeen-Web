<?php
if($_GET['action'] == 'add'){
  $title = 'Ajouter un fichier';
  if(isset($_POST['add']) && isset($_FILES['file'])){
  	$name = strtolower($_FILES['file']['name']);
  	$name = preg_replace('#([^._a-z0-9])+#', '_', $name);
  	move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/'.$name);
    $error = '<div class="alert alert-success">Le fichier a bien été ajouté !</div>';
    $_GET['action'] = 'view';
  }
}
if($_GET['action'] == 'delete' && isset($_GET['id'])){
  $title = 'Supprimer un fichier';
  $name = '../uploads/'.$_GET['id'];
  if(unlink($name)){
    $error = '<div class="alert alert-success">Le fichier a bien été supprimé !</div>';
    $_GET['action'] = 'view';
  }else{
    $error = '<div class="alert alert-danger">Une erreur est survenue lors de la suppression du fichier !</div>';
  }
}
if($_GET['action'] == 'view'){
  $title = 'Fichiers';
}

function listDir($dir, $add, $url) {
	$files = scandir($dir);
	foreach ($files as $key => $value) {
		if(!in_array($value, array('.', '..'))){
			if(!preg_match('#^[\.\_a-z0-9]+$#', $value)){
				$name = strtolower($value);
				$name = preg_replace('#([^._a-z0-9])+#', '_', $name);
				rename('../uploads/'.$add.$value, '../uploads/'.$add.$name);
				$value = $name;
			}
			if(is_file('../uploads/'.$add.$value)){
				echo '<tr>
					<td>'.$add.$value.'</td>
					<td>
						<a href="'.$url.'../uploads/'.$add.$value.'"><span class="glyphicon glyphicon-eye-open"></span></a>
						<a href="'.$url.'uploads/delete/'.$add.$value.'"><span class="glyphicon glyphicon-remove"></span></a>
					</td>
				</tr>';
			}else{
				listDir('images/'.$add.$value.'/', $add.$value.'/', $url);
			}
		}
	}
}
?>
