<div class="content-box">
  <div class="panel-body">
    <h2>Footer</h2>
    <p>Modifiez les informations du footer du site</p>
    <form method="post">
      <div class="form-group">
        <label for="address">Adresse :</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Adresse" value="<?php echo $footer['address']; ?>">
      </div>
      <div class="form-group">
        <label for="phone">Téléphone :</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="N° de téléphone" value="<?php echo $footer['phone']; ?>">
      </div>
      <div class="form-group">
        <label for="mail">Mail :</label>
        <input type="text" class="form-control" id="mail" name="mail" placeholder="E-mail" value="<?php echo $footer['mail']; ?>">
      </div>
      <div class="form-group">
        <label for="facebook">Facebook :</label>
        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Adresse de la page Facebook" value="<?php echo $footer['facebook']; ?>">
      </div>
      <input type="submit" name="submit" value="Mettre à jour" class="btn btn-primary">
    </form>
  </div>
</div>
