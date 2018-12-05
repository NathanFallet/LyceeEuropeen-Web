<?php
if($_GET['action'] == 'view'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Articles</h2>
    <p>Configurez les articles ici.</p>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titre</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
$sql = $bdd->query("SELECT * FROM articles".($account['admin'] ? "" : " WHERE owner = ".$account['id']));
while($dn = $sql->fetch()){
?>
        <tr>
          <td><?php echo $dn['id']; ?></td>
          <td><?php echo $dn['title']; ?></td>
          <td>
            <a href="<?php echo $url.'articles/edit/'.$dn['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="<?php echo $url.'articles/delete/'.$dn['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a>
          </td>
        </tr>
<?php
}
?>
      </tbody>
    </table>
    <p><a href="<?php echo $url; ?>articles/add/" class="btn btn-primary">+ Ajouter un article</a></p>
  </div>
</div>
<?php
}else if($_GET['action'] == 'add'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Ajouter un article</h2>
    <p>Entrez ici les informations concernant l'article à ajouter.</p>
    <form method="post">
      <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article">
      </div>
      <div class="form-group">
        <label for="content">Contenu :</label>
        <textarea class="form-control" id="content" name="content" placeholder="Contenu de l'article"></textarea>
      </div>
      <div class="form-group">
        <label for="image">Adresse de l'image :</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="http://...">
      </div>
      <input type="submit" name="submit" value="Ajouter l'article" class="btn btn-primary">
    </form>
  </div>
</div>
<?php
  $editor = 'textarea#content';
}else if($_GET['action'] == 'edit' && isset($_GET['id'])){
  $sql = $bdd->prepare("SELECT * FROM articles WHERE id = ?");
  $sql->execute(array($_GET['id']));
  $dn = $sql->fetch();
  if($dn){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Modifier un article</h2>
    <p>Entrez ici les informations concernant l'article à modifier.</p>
    <form method="post">
      <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article" value="<?php echo $dn['title']; ?>">
      </div>
      <div class="form-group">
        <label for="content">Contenu :</label>
        <textarea class="form-control" id="content" name="content" placeholder="Contenu de l'article"><?php echo $dn['content']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="image">Adresse de l'image :</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="http://..." value="<?php echo $dn['image']; ?>">
      </div>
      <input type="submit" name="submit" value="Modifier l'article" class="btn btn-primary">
    </form>
  </div>
</div>
<?php
    $editor = 'textarea#content';
  }
}
?>
