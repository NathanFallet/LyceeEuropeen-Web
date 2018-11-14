<?php
if(isset($dn)){
?>
<div class="wrapper row3">
  <div class="rounded">
    <main class="container clear">
      <div class="group">
        <div class="first">
          <h2><?php echo $dn['title']; ?></h2>
          <ul class="nospace listing">
            <div class="imgl borderedbox"><img src="<?php echo parseURL($dn['image'], $url); ?>" alt=""></div>
            <p><?php echo $dn['content']; ?></p>
            <p class="right">Publié le <?php echo date('d/m/Y', strtotime($dn['publish'])); ?></p>
          </ul>
        </div>
      </div>
    </main>
  </div>
</div>
<?php
}else{
?>
<div class="wrapper row3">
  <div class="rounded">
    <main class="container clear">
      <div class="group">
        <div class="first">
          <h2>Nos articles</h2>
          <ul class="nospace listing">
<?php
$sql = $bdd->query("SELECT * FROM articles ORDER BY publish DESC");
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
        </div>
      </div>
    </main>
  </div>
</div>
<?php
}
?>
