<?php
session_start();

if(!isset($_SESSION['id'])){
  require('login.php');
  exit;
}

// Définitions des variables nécessaires
require('config.php');
$page = 'home';
if(isset($_GET['page']) && !empty($_GET['page'])){
	$page = $_GET['page'];
}
if(!file_exists('views/'.$page.'.php') || !file_exists('models/'.$page.'.php')){
	$page = '404';
	http_response_code(404);
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
