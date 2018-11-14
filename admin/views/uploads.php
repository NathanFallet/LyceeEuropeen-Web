<?php
if($_GET['action'] == 'view'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Fichiers</h2>
    <p>Ajoutez ou supprimez des fichiers ici.</p>
    <table class="table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
listDir('../uploads', '', $url);
?>
      </tbody>
    </table>
    <p><a href="<?php echo $url; ?>uploads/add/" class="btn btn-primary">+ Ajouter un fichier</a></p>
  </div>
</div>
<?php
}else if($_GET['action'] == 'add'){
?>
<div class="content-box">
  <div class="panel-body">
    <h2>Ajouter un fichier</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="file">Fichier :</label>
        <input type="file" name="file" id="file">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add" value="Ajouter">
      </div>
    </form>
  </div>
</div>
<?php
}
?>
