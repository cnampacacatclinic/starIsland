<?php require_once '../config/function.php';
if (!empty($_POST)) {


    if (empty($_POST['title_media'])) {

        $error = 'Ce champs est obligatoire';

    }

    if (!isset($error)) {

        if (empty($_POST['id_media'])) {


            execute("INSERT INTO media (title_media) VALUES (:title_media)", array(
                ':title_media' => $_POST['title_media']
            ));

            $_SESSION['messages']['success'][] = 'Média type ajouté';
            header('location:./backmedia.php');
            exit();
        }// fin soumission en insert
        else {

            execute("UPDATE media SET title_media=:title WHERE id_media=:id", array(
                ':id' => $_POST['id_media'],
                ':title' => $_POST['title_media']
            ));

            $_SESSION['messages']['success'][] = 'Média type modifié';
            header('location:./backmedia.php');
            exit();


        }// fin soumission modification
    }// fin si pas d'erreur

}// fin !empty $_POST

$medias = execute("SELECT id_media, title_media, name_media, page.id_page, media_type.id_media_type, title_media_type,title_page FROM media
INNER JOIN page
ON page.id_page=media.id_page
INNER JOIN media_type
ON media_type.id_media_type=media.id_media_type")->fetchAll(PDO::FETCH_ASSOC);

//debug($medias);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $media = execute("SELECT id_media, title_media, name_media, page.id_page, media_type.id_media_type, title_media_type,title_page FROM media
INNER JOIN page
ON page.id_page=media.id_page
INNER JOIN media_type
ON media_type.id_media_type=media.id_media_type
WHERE id_media=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
    //debug($media);


}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {

    $success = execute("DELETE FROM media WHERE id_media=:id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Média supprimé';
        header('location:./backmedia.php');
        exit;

    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location:./backmedia.php');
        exit;


    }

}


require_once '../inc/backheader.inc.php';
?>

<h2>MEDIA</h2>
<p class="text-danger">ATTENTION ! LES MODIFICATIONS ET LES SUPPRESSIONS PEUVENT CASSER VOTRE SITE !</p>
    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="media" class="form-label">Nom du type de média</label>
            <input name="title_media" id="media" placeholder="Nom du type de média" type="text"
                   value="<?= $media['title_media'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input type="hidden" name="id_media" value="<?= $media['id_media'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Nom du média</th>
            <th>Déscription du média</th>
            <th>Nom du type du média</th>
            <th>Nom de la page</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($medias as $media): ?>
            <tr>
                <td><?= $media['title_media']; ?></td>
                <td><?= $media['name_media']; ?></td>
                <td><?= $media['title_media_type']; ?></td>
                <td><?= $media['title_page']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $media['id_media']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $media['id_media']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>