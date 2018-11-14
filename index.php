<?php
session_start();

function cutArticle($content){
	$content = preg_replace('~<(.*?)>~s', '', $content);
	if(strlen($content) > 255){
		$content = substr($content, 0, 255).'...';
	}
	return $content;
}

function parseURL($current, $url){
	if(substr($current, 0, 4) === "http" || substr($current, 0, 5) === "https"){
		return $current;
	}
	return $url.'uploads/'.$current;
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
  echo $title.' - Lycée européen';
}else{
  echo 'Lycée européen';
}
?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="<?php echo $url; ?>layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="logo" class="fl_left">
      <h1><a href="<?php echo $url; ?>">Lycée européen - Villers-Cotter&ecirc;ts</a></h1>
    </div>
  </header>
</div>
<div class="wrapper row2">
  <div class="rounded">
    <nav id="mainav" class="clear">
      <ul class="clear">
        <li<?php echo ($page == 'home' ? ' class="active"' : ''); ?>><a href="<?php echo $url; ?>">Accueil</a></li>
        <li<?php echo ($page == 'article' ? ' class="active"' : ''); ?>><a href="<?php echo $url; ?>articles">Articles</a></li>
        <li<?php echo ($page == 'page' ? ' class="active"' : ''); ?>><a class="drop" href="#">Formations</a>
          <ul>
<?php
$sql_menu = $bdd->query("SELECT * FROM pages");
while($dn_menu = $sql_menu->fetch()){
	echo '<li><a href="'.$url.'pages/'.$dn_menu['id'].'">'.$dn_menu['name'].'</a></li>';
}
?>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<?php
require_once('views/'.$page.'.php');
?>
<div class="wrapper row4">
  <div class="rounded">
    <footer id="footer" class="clear">
      <div class="one_half">
        <address>
        19 Avenue de Noue<br>
        02600 Villers-Cotter&ecirc;ts<br>
        <br>
        <i class="fa fa-phone pright-10"></i> xxxx xxxx xxxxxx<br>
        <i class="fa fa-envelope-o pright-10"></i> <a href="#">contact@domain.com</a>
        </address>
      </div>
      <div class="one_half">
        <p class="nospace btmspace-10">Réseaux sociaux</p>
        <ul class="faico clear">
          <!--<li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>-->
          <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <!--<li><a class="faicon-flickr" href="#"><i class="fa fa-flickr"></i></a></li>
          <li><a class="faicon-rss" href="#"><i class="fa fa-rss"></i></a></li>-->
        </ul>
      </div>
    </footer>
  </div>
</div>
<div class="wrapper row5">
  <div id="copyright" class="clear">
    <p class="fl_left">Site développé par <a target="_blank" href="https://www.nathanfallet.me/">Nathan Fallet</a></p>
    <p class="fl_right">Template HTML/CSS by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div>
<!-- JAVASCRIPTS -->
<script src="<?php echo $url; ?>layout/scripts/jquery.min.js"></script>
<script src="<?php echo $url; ?>layout/scripts/jquery.fitvids.min.js"></script>
<script src="<?php echo $url; ?>layout/scripts/jquery.mobilemenu.js"></script>
<script src="<?php echo $url; ?>layout/scripts/tabslet/jquery.tabslet.min.js"></script>
</body>
</html>
