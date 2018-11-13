<?php
if($_GET['action'] == 'view'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Comptes</h2>
    <p>Configurez les comptes ici.</p>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Identifiant</th>
          <th>Administrateur</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
$sql = $bdd->query("SELECT * FROM accounts");
while($dn = $sql->fetch()){
?>
        <tr>
          <td><?php echo $dn['id']; ?></td>
          <td><?php echo $dn['username']; ?></td>
          <td><?php echo ($dn['admin'] ? 'Oui' : 'Non'); ?></td>
          <td>
            <a href="<?php echo $url.'accounts/delete/'.$dn['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a>
          </td>
        </tr>
<?php
}
?>
      </tbody>
    </table>
    <p><a href="<?php echo $url; ?>accounts/add/" class="btn btn-primary">+ Ajouter un compte</a></p>
  </div>
</div>
<?php
}else if($_GET['action'] == 'add'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Ajouter un compte</h2>
    <p>Entrez ici les informations concernant le compte à ajouter.</p>
    <form method="post">
      <div class="form-group">
        <label for="username">Identifiant :</label>
        <input type="text" class="form-control" id="title" name="username" placeholder="Identifiant de l'utilisateur">
      </div>
      <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
        <input type="password" class="form-control" id="password" name="password2" placeholder="Confirmez le mot de passe">
      </div>
      <div class="form-group">
        <label for="admin">Administrateur (peut gérer les comptes) :</label>
        <input type="checkbox" class="form-control" id="admin" name="admin">
      </div>
      <input type="submit" name="submit" value="Ajouter le compte" class="btn btn-primary">
    </form>
  </div>
</div>
<?php
}
?>
