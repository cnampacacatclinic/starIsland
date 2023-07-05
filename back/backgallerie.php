<?php require_once '../config/function.php';
require_once '../config/fonctionMod.php';

$table="media";
$page="backgallerie.php";
$idTable="id_media";

//debug($_FILES);
//die();

if (!empty($_POST)) {
 
    if (empty($_POST['name_media']) && empty($_FILES)) {

        $error = '<p>Ce champs est obligatoire</p>';
    }

    //Si on obtient un fichier
    if (!empty($_FILES)){
            //on verifie le format du fichier        
            $errorImg="";
            $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];
            if (!in_array($_FILES['photoAlbum']['type'],$formats )){
            $errorImg.="Les formats d'image autorisés sont: les png, les jpg et les webp<br>";

            //On verifie la taille du fichier
            if ($_FILES['photoAlbum']['size'] > 2000000){
                $errorImg.="La taille maximale autorisée pour le fichier, est de 2M";
            }//fin de si la taille est bonne
         }//fin de si le format est bon   
    }//fin de si on obtient le fichier
    /**/


    /*if (!isset($error) || !isset($errorImg)) {
        if (empty($_GET['id'])) {
            
            execute("INSERT INTO media (name_media,title_media) VALUES (:name_media,:title_media)", array(
                ':name_media' => trim(htmlspecialchars($_POST['name_media'])),
                ':title_media' => trim(htmlspecialchars($_POST['title_media']))
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe ajouté';
        }// fin soumission en insert
        else {
            
            execute("UPDATE media SET name_media=:name_media,title_media=:title_media WHERE id_media=:id", array(
                ':id' => $_POST['id_media'],
                ':name_media' => $_POST['name_media'],
                ':title_media' => $_POST['title_media']
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe modifié';

        }// fin soumission modification
    }// fin si pas d'erreur/**/
}// fin !empty $_POST

$imgs = execute("SELECT * FROM media WHERE id_page=6")->fetchAll(PDO::FETCH_ASSOC);


if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $media = execute("SELECT * FROM media WHERE id_media=:id AND id_page=6", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

Delete($table,$idTable,$page);

require_once '../inc/backheader.inc.php';
?>

<h2>Album pour la gallerie</h2>
    <form enctype="multipart/form-data" action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="media" class="form-label">Alt</label>
            <input name="alt" id="alt" placeholder="Alt" type="text"
                   value="<?= $media['title_media'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <small class="text-danger">*</small>
            <label for="photoAlbum" class="form-label">Photo</label>
            <input name="photoAlbum" type="file" class="form-control" id="photoAlbum">
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input type="hidden" name="id_media" value="<?= $media['id_media'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Vignette</th>
            <th>alt</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($imgs as $img): ?>
            <tr>
                <td><img alt="Vignette" src="../assets/album/<?= $img['name_media']; ?>" width="100px"></td>
                <td><?= $img['name_media']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $img['id_media']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $img['id_media']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>