<?php
if($_GET['action'] == 'view'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Pages</h2>
    <p>Configurez les pages ici.</p>
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
$sql = $bdd->query("SELECT * FROM pages".($account['admin'] ? "" : " WHERE owner = ".$account['id']));
while($dn = $sql->fetch()){
?>
        <tr>
          <td><?php echo $dn['id']; ?></td>
          <td><?php echo $dn['name']; ?></td>
          <td>
            <a href="<?php echo $url.'pages/edit/'.$dn['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="<?php echo $url.'pages/delete/'.$dn['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a>
          </td>
        </tr>
<?php
}
?>
      </tbody>
    </table>
    <p><a href="<?php echo $url; ?>pages/add/" class="btn btn-primary">+ Ajouter une page</a></p>
  </div>
</div>
<?php
}else if($_GET['action'] == 'add'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Ajouter une page</h2>
    <p>Entrez ici les informations concernant la page à ajouter.</p>
    <form method="post">
      <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la page">
      </div>
      <div class="form-group">
        <label for="text">Texte :</label>
        <textarea class="form-control" id="text" name="text" placeholder="Texte affiché sur la page"></textarea>
      </div>
      <input type="submit" name="submit" value="Ajouter la page" class="btn btn-primary">
    </form>
  </div>
</div>
<?php
  $editor = 'textarea#text';
}else if($_GET['action'] == 'edit' && isset($_GET['id'])){
  $sql = $bdd->prepare("SELECT * FROM pages WHERE id = ?");
  $sql->execute(array($_GET['id']));
  $dn = $sql->fetch();
  if($dn){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Modifier une page</h2>
    <p>Entrez ici les informations concernant la page à modifier.</p>
    <form method="post">
      <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la page" value="<?php echo $dn['name']; ?>">
      </div>
      <div class="form-group">
        <label for="text">Texte :</label>
        <textarea class="form-control" id="text" name="text" placeholder="Texte affiché sur la page"><?php echo $dn['text']; ?></textarea>
      </div>
      <input type="submit" name="submit" value="Modifier la page" class="btn btn-primary">
    </form>
  </div>
</div>
<?php
    $editor = 'textarea#text';
  }
}
?>
