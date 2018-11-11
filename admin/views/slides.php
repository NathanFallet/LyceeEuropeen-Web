<?php
if($_GET['action'] == 'view'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Slides</h2>
    <p>Configurez les slides de la page d'accueil ici.</p>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
$sql = $bdd->query("SELECT * FROM slides");
while($dn = $sql->fetch()){
?>
        <tr>
          <td><?php echo $dn['id']; ?></td>
          <td><?php echo $dn['name']; ?></td>
          <td>
            <a href="<?php echo $url.'slides/edit/'.$dn['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="<?php echo $url.'slides/delete/'.$dn['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a>
          </td>
        </tr>
<?php
}
?>
      </tbody>
    </table>
    <p><a href="<?php echo $url; ?>slides/add/" class="btn btn-primary">+ Ajouter une slide</a></p>
  </div>
</div>
<?php
}else if($_GET['action'] == 'add'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Ajouter une slide</h2>
    <p>Entrez ici les informations concernant la slide à ajouter.</p>
    <form method="post">
      <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la slide">
      </div>
      <div class="form-group">
        <label for="text">Texte :</label>
        <textarea class="form-control" id="text" name="text" placeholder="Texte affiché sur la slide"></textarea>
      </div>
      <div class="form-group">
        <label for="image">Adresse de l'image :</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="http://...">
      </div>
      <input type="submit" name="submit" value="Ajouter la slide" class="btn btn-primary">
    </form>
  </div>
</div>
<?php
  $editor = 'textarea#text';
}else if($_GET['action'] == 'edit' && isset($_GET['id'])){
  $sql = $bdd->prepare("SELECT * FROM slides WHERE id = ?");
  $sql->execute(array($_GET['id']));
  $dn = $sql->fetch();
  if($dn){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Modifier une slide</h2>
    <p>Entrez ici les informations concernant la slide à modifier.</p>
    <form method="post">
      <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la slide" value="<?php echo $dn['name']; ?>">
      </div>
      <div class="form-group">
        <label for="text">Texte :</label>
        <textarea class="form-control" id="text" name="text" placeholder="Texte affiché sur la slide"><?php echo $dn['text']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="image">Adresse de l'image :</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="http://..." value="<?php echo $dn['image']; ?>">
      </div>
      <input type="submit" name="submit" value="Modifier la slide" class="btn btn-primary">
    </form>
  </div>
</div>
<?php
    $editor = 'textarea#text';
  }
}
?>
