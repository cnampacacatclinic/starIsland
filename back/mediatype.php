<?php     

require_once '../config/function.php';

if(!empty($_POST)):

   // debug($_POST);
    if(empty($_POST['title_media_type'])):
        $error='Veuillez remplir ce champ.';
    endif;
if(!isset($error)){
    execute("INSERT INTO media_type (title_media_type) VALUES (:title_media_type)", array(
        ":title_media_type"=>$_POST['title_media_type']
    ));
    //SESSION[]
    header('location:./mediatype.php');
    exit();
}
endif;
require_once '../inc/backheader.inc.php';
?>

<form action="" method="POST">
  <div class="form-group">
    <label for="text">text</label>
    <input name="title_media_type" class="form-control w-75 p-3" type="text" placeholder="Readonly input here…" >
    <small class="text-danger"><?=$error ?? '';?></small>
</div>
  <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">titre</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><a class="btn-danger" onclick="return confirm('Vous êtes vraiment sûr ?')";>Supprimer</a></td>
      <td><a class="btn-warning">Modifier</a></td>
    </tr>
  </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php';?>