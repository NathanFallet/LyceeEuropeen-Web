<?php
session_start();

// Définitions des variables nécessaires
require('config.php');

if(isset($_POST['submit'])){
  $sql = $bdd->prepare("SELECT * FROM accounts WHERE username = ?");
  $sql->execute(array($_POST['username']));
  $dn = $sql->fetch();
  if($dn && password_verify($_POST['password'], $dn['password'])){
    $_SESSION['id'] = $dn['id'];
    header('refresh: 0');
    exit;
  }else{
    $error = '<div class="alert alert-danger">Nom d\'utilisateur ou mot de passe incorrecte !</div>';
  }
}
?><!DOCTYPE html>
<html>
  <head>
    <title>Connexion - EuropAdmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo $url; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo $url; ?>css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="<?php echo $url; ?>">EuropAdmin</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Connexion</h6>
<?php
if(isset($error)){
  echo $error;
}
?>
                      <form method="post">
                        <input class="form-control" name="username" type="text" placeholder="Nom d'utilisateur">
  			                <input class="form-control" name="password" type="password" placeholder="Mot de passe">
  			                <div class="action">
  			                    <input name="submit" type="submit" class="btn btn-primary signup" value="Connexion">
  			                </div>
                      </form>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
