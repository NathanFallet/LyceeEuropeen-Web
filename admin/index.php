<?php
session_start();

if(!isset($_SESSION['id'])){
  require('login.php');
  exit;
}

// Définitions des variables nécessaires
require('config.php');

$sql = $bdd->prepare("SELECT * FROM accounts WHERE id = ?");
$sql->execute(array($_SESSION['id']));
$account = $sql->fetch();

if(!$account){
  require('login.php');
  exit;
}

$page = 'home';
if(isset($_GET['page']) && !empty($_GET['page'])){
	$page = $_GET['page'];
}
if(!file_exists('views/'.$page.'.php') || !file_exists('models/'.$page.'.php')){
	$page = '404';
	http_response_code(404);
}

if ($account['admin'] == 0 && $page == 'accounts') {
  $page = '403';
}else if ($account['admin'] == 0 && $page == 'footer') {
  $page = '403';
}else if ($account['slides'] == 0 && $page == 'slides') {
  $page = '403';
}else if ($account['pages'] == 0 && $page == 'pages') {
  $page = '403';
}else if ($account['articles'] == 0 && $page == 'articles') {
  $page = '403';
}else if ($account['uploads'] == 0 && $page == 'uploads') {
  $page = '403';
}

// Traitement de la page
require_once('models/'.$page.'.php');

// Header de la page
?><!DOCTYPE html>
<html>
  <head>
    <title><?php
    if(isset($title)){
      echo $title.' - EuropAdmin';
    }else{
      echo 'EuropAdmin';
    }
    ?></title>
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
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="<?php echo $url; ?>">EuropAdmin</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon compte <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="<?php echo $url; ?>logout.php">Déconnexion</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>


<!------>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li<?php echo ($page == 'home' ? ' class="current"' : ''); ?>><a href="<?php echo $url; ?>"><i class="glyphicon glyphicon-home"></i> Accueil</a></li>
                    <li<?php echo ($page == 'slides' ? ' class="current"' : ''); ?>><a href="<?php echo $url; ?>slides/view/"><i class="glyphicon glyphicon-picture"></i> Slides</a></li>
                    <li<?php echo ($page == 'pages' ? ' class="current"' : ''); ?>><a href="<?php echo $url; ?>pages/view/"><i class="glyphicon glyphicon-list"></i> Pages</a></li>
                    <li<?php echo ($page == 'articles' ? ' class="current"' : ''); ?>><a href="<?php echo $url; ?>articles/view/"><i class="glyphicon glyphicon-pencil"></i> Articles</a></li>
                    <li<?php echo ($page == 'uploads' ? ' class="current"' : ''); ?>><a href="<?php echo $url; ?>uploads/view/"><i class="glyphicon glyphicon-file"></i> Fichiers</a></li>
                    <li<?php echo ($page == 'footer' ? ' class="current"' : ''); ?>><a href="<?php echo $url; ?>footer/"><i class="glyphicon glyphicon-info-sign"></i> Footer</a></li>
                    <li<?php echo ($page == 'accounts' ? ' class="current"' : ''); ?>><a href="<?php echo $url; ?>accounts/view/"><i class="glyphicon glyphicon-user"></i> Comptes</a></li>
                </ul>
             </div>
		    </div>
		    <div class="col-md-10">
        <?php
        if(isset($error)){
          echo $error;
        }
        require_once('views/'.$page.'.php');
        ?>
		    </div>
    </div>
    <footer>
         <div class="container">

            <div class="copy text-center">
               EuropAdmin développé par <a target="_blank" href="https://www.nathanfallet.me/">Nathan Fallet</a>
            </div>

         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $url; ?>bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php echo $url; ?>vendors/ckeditor/ckeditor.js"></script>
    <script src="<?php echo $url; ?>vendors/ckeditor/adapters/jquery.js"></script>

    <script src="<?php echo $url; ?>js/custom.js"></script>
<?php
if(isset($editor)){
  echo '<script type="text/javascript">
    $(\''.$editor.'\').ckeditor({width:\'98%\', height: \'150px\'});
  </script>';
}
?>
  </body>
</html>
