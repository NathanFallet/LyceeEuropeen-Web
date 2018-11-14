<div class="wrapper">
  <div id="slider">
    <div id="slide-wrapper" class="rounded clear">
<?php
$sql = $bdd->query("SELECT * FROM slides ORDER BY id DESC LIMIT 5");
$titles = array();
while($dn = $sql->fetch()){
?>
      <figure id="slide-<?php echo $dn['id']; ?>"><img src="<?php echo parseURL($dn['image'], $url); ?>" alt="">
        <figcaption>
          <h2><?php echo $dn['name']; ?></h2>
          <p><?php echo $dn['text']; ?></p>
        </figcaption>
      </figure>
<?php
  $titles[] = array('name' => $dn['name'], 'id' => $dn['id']);
}
?>
      <ul id="slide-tabs">
<?php
foreach ($titles as $value) {
  echo '<li><a href="#slide-'.$value['id'].'">'.$value['name'].'</a></li>';
}
?>
      </ul>
    </div>
  </div>
</div>
<div class="wrapper row3">
  <div class="rounded">
    <main class="container clear">
      <div class="group">
        <div class="first">
          <h2>Derniers articles</h2>
          <ul class="nospace listing">
<?php
$sql = $bdd->query("SELECT * FROM articles ORDER BY publish DESC LIMIT 5");
while($dn = $sql->fetch()){
?>
            <li class="clear">
              <div class="imgl borderedbox"><img src="<?php echo parseURL($dn['image'], $url); ?>" alt=""></div>
              <p class="nospace btmspace-15"><a href="<?php echo $url.'articles/'.$dn['id']; ?>"><?php echo $dn['title']; ?></a></p>
              <p><?php echo cutArticle($dn['content']); ?></p>
              <p class="right"><a href="<?php echo $url.'articles/'.$dn['id']; ?>">Lire la suite &raquo;</a></p>
            </li>
<?php
}
?>
          </ul>
          <p class="right"><a href="<?php echo $url; ?>articles">Voir tous les articles &raquo;</a></p>
        </div>
      </div>
    </main>
  </div>
</div>
