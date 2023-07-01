<?php require_once '../config/function.php';
$medias = execute("SELECT id_media, title_media, name_media, page.id_page, media_type.id_media_type, title_media_type,title_page FROM media
INNER JOIN page
ON page.id_page=media.id_page
INNER JOIN media_type
ON media_type.id_media_type=media.id_media_type")->fetchAll(PDO::FETCH_ASSOC);

$pages = execute("SELECT * FROM page GROUP BY id_page")->fetchAll(PDO::FETCH_ASSOC);
$mediasType = execute("SELECT * FROM media_type GROUP BY id_media_type")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $media = execute("SELECT id_media, title_media, name_media, page.id_page AS idPage, media_type.id_media_type AS idMedia, title_media_type,title_page FROM media
INNER JOIN page
ON page.id_page=media.id_page
INNER JOIN media_type
ON media_type.id_media_type=media.id_media_type
WHERE id_media=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
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

if (!empty($_POST)) {

//TODO
    if (empty($_POST['title_media']) && empty($_POST['lien_media']) && empty($_POST['id_media'])) {

        $error = 'Ce champs est obligatoire';

    }

    if (!isset($error)) {

        if (empty($_POST['id_media'])) {
            //insertion dans la table media
            execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,:id_page,:id_media_type)", array(
                ':title_media' => $_POST['title_media'],
                ':name_media' => $_POST['lien_media'],
                ':id_page' => $_POST['id_page1'],
                ':id_media_type' => $_POST['id_type1']
            ));

            $_SESSION['messages']['success'][] = 'Média ajouté';
            header('location:./backmedia.php');
            exit();
        }// fin soumission en insert
        else {
            $idPage = $_POST['id_page1'] ? $_POST['id_page1'] : $_POST['id_page2'];
            $idMedia = $_POST['id_type1'] ? $_POST['id_type1'] : $_POST['id_type2'];

            execute("UPDATE media SET title_media=:title,name_media=:name_media,id_page=:id_page,id_media_type=:id_media_type WHERE id_media=:id", array(
                ':id' => $_POST['id_media'],
                ':title' => $_POST['title_media'],
                ':name_media' => $_POST['lien_media'],
                ':id_page' => $idPage,
                ':id_media_type' => $idMedia
            ));

            $_SESSION['messages']['success'][] = 'Média type modifié';
            header('location:./backmedia.php');
            exit();


        }// fin soumission modification
    }// fin si pas d'erreur

}// fin !empty $_POST


require_once '../inc/backheader.inc.php';
?>

<h2>MEDIA</h2>
<p class="text-danger">ATTENTION ! LES MODIFICATIONS ET LES SUPPRESSIONS PEUVENT CASSER VOTRE SITE !</p>
    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <!-- Select pour obtenir les pages -->
            <small class="text-danger">*</small>
            <label for="media" class="form-label">Page:</label>
            <select class="custom-select" name="id_page1">
                <option selected value="">
                    Choisir une page *
                </option>
                <?php foreach ($pages as $page): ?>
                    <option value="<?=$page['id_page'] ?? '';?>"><?=$page['title_page'];?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="id_page2" value="<?=$media['idPage'] ?? ''; ?>">
            <small class="text-danger"><?= $error ?? ''; ?></small><br>
            
            <!-- Select pour obtenir les types -->
            <small class="text-danger">*</small>
            <label for="media" class="form-label">Type:</label>
            <select class="custom-select" name="id_type1">
                <option selected value="">
                    Choisir un type *
                </option>
                <?php foreach ($mediasType as $media2): ?>
                    <option value="<?=$media2['id_media_type'] ?? '';?>"><?=$media2['title_media_type'];?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="id_type2" value="<?=$media2['idMedia'] ?? ''; ?>">
            <small class="text-danger"><?= $error ?? ''; ?></small><br>
                
            <!-- Input pour obtenir le nom du media -->
            <small class="text-danger">*</small>
            <label for="media" class="form-label">Nom du média:</label>
            <input name="title_media" id="media" placeholder="Nom du média" type="text"
                   value="<?= $media['title_media'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small><br>

            <!-- Input pour obtenir le lien vers le média -->
            <small class="text-danger">*</small>
            <label for="media" class="form-label">Lien vers le média:</label>
            <input name="lien_media" id="media" placeholder="Lien vers le média" type="text"
                   value="<?= $media['name_media'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small><br>
        </div>
        <!-- id -->
        <input type="hidden" name="id_media" value="<?= $_GET['id'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Nom du média</th>
            <th>Lien vers le média</th>
            <th>Nom du type du média</th>
            <th>Nom de la page</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($medias as $media2): ?>
            <tr>
                <td><?= $media2['title_media']; ?></td>
                <td><?= $media2['name_media']; ?></td>
                <td><?= $media2['title_media_type']; ?></td>
                <td><?= $media2['title_page']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $media2['id_media']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $media2['id_media']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>