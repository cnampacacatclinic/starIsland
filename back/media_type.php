<?php     require_once '../config/function.php';


  if (!empty($_POST) && empty($_POST['id_media_type'])){

      if (empty($_POST['title_media_type'])){
          $errror='Ce champs est obligatoire';

      }


      if (!isset($error)){

          execute("INSERT INTO media_type (title_media_type) VALUES (:title_media_type)", array(
                  ':title_media_type'=>$_POST['title_media_type']
          ));

          $_SESSION['messages']['success'][]='Média type ajouté';
          header('location:./media_type.php');
          exit();

      }

  }// fin !empty $_POST

   $medias_type=execute("SELECT * FROM media_type")->fetchAll(PDO::FETCH_ASSOC);

  //debug($medias_type);

   if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a']=='edit'){

       $media_type=execute("SELECT * FROM media_type WHERE id_media_type=:id", array(
           ':id'=>$_GET['id']
       ))->fetch(PDO::FETCH_ASSOC);
   //debug($media_type);


   }
   //supprime
   if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a']=='del'){

    $success=execute("DELETE FROM media_type WHERE id_media_type=:id", array(
        ':id'=>$_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);

        if($success){
            $_SESSION['messages']['success'][]='Média type supprimé';
            header('location:./media_type.php');
        } else {
            $_SESSION['messages']['success'][]='Problème de traitement! Veuillez réitérer';
            header('location:./media_type.php');
        }

    }


   if (!empty($_POST) && !empty($_POST['id_media_type'])){

       execute("UPDATE media_type SET title_media_type=:title WHERE id_media_type=:id", array(
               ':id'=>$_POST['id_media_type'],
               ':title'=>$_POST['title_media_type']
       ) );

       $_SESSION['messages']['success'][]='Média type modifié';
       header('location:./media_type.php');
       exit();


   }// fin soumission modification


require_once '../inc/backheader.inc.php';
?>


    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="media_type" class="form-label">Nom du type de média</label>
            <input name="title_media_type" id="media_type" placeholder="Nom du type de média" type="text" value="<?=  $media_type['title_media_type']  ?? ''; ?>" class="form-control">
            <small class="text-danger"><?=  $errror ?? ''; ?></small>
        </div>
        <input type="hidden" name="id_media_type" value="<?=  $media_type['id_media_type'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-dark table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Titre</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
   <?php     foreach ($medias_type  as $media_type):           ?>
        <tr>
            <td><?=  $media_type['title_media_type']; ?></td>
            <td class="text-center">
                <a href="?id=<?=  $media_type['id_media_type']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                <a href="?id=<?=  $media_type['id_media_type']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')" class="btn btn-outline-danger">Supprimer</a>
            </td>
        </tr>
  <?php     endforeach;           ?>
        </tbody>
    </table>






















<?php     require_once '../inc/backfooter.inc.php';           ?>