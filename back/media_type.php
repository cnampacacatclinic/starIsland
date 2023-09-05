<?php 
/*/////////////////////////////////
* Catherine Jules
* Date : Juin / Juillet 2023
* TP pour SIMPLON
* CDA
* NB: Le TP est en PHP procédural 
car c'était demandé pour cet
exercice.
/////////////////////////////////*/

$table="media_type";
$page="backmediatype";
$idTable="id_media_type";
$idD=isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($_POST)) {


    if (empty($_POST['title_media_type'])) {

        $error = 'Ce champs est obligatoire.';

    }

    if (!isset($error)) {

        if (empty($_POST['id_media_type'])) {

            execute("INSERT INTO media_type (title_media_type) VALUES (:title_media_type)", array(
                ':title_media_type' => trim(htmlspecialchars($_POST['title_media_type']))
            ));

            messageSession($page);
        }// fin soumission en insert
        else {

            execute("UPDATE media_type SET title_media_type=:title WHERE id_media_type=:id", array(
                ':id' => trim(htmlspecialchars($_POST['id_media_type'])),
                ':title' => trim(htmlspecialchars($_POST['title_media_type']))
            ));

            messageSession($page);

        }// fin soumission modification
    }// fin si pas d'erreur

}// fin !empty $_POST

$medias_type = execute("SELECT * FROM media_type")->fetchAll(PDO::FETCH_ASSOC);

//debug($medias_type);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $media_type = execute("SELECT * FROM media_type WHERE id_media_type=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
    //debug($media_type);


}

Delete($table,$idTable,$idD,$page);
$errorD=Delete($table,$idTable,$idD,$page);

require_once '../inc/backheader.inc.php';
?>
<h2>LES TYPES DE MEDIA</h2>
<p class="text-danger">ATTENTION ! LES MODIFICATIONS ET LES SUPPRESSIONS PEUVENT CASSER VOTRE SITE !</p>
<?php $m=!empty($errorD) ? '<p class="text-danger">'.var_dump($errorD).'</p>' : '';
echo $m;?>
    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="media_type" class="form-label">Nom du type de média</label>
            <input name="title_media_type" id="media_type" placeholder="Nom du type de média" type="text"
                   value="<?= $media_type['title_media_type'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input type="hidden" name="id_media_type" value="<?= $media_type['id_media_type'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Titre</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($medias_type as $media_type): ?>
            <tr>
                <td><?= $media_type['title_media_type']; ?></td>
                <td class="text-center">
                    <a href="?p=<?= $page; ?>&id=<?= $media_type['id_media_type']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?p=<?= $page; ?>&id=<?= $media_type['id_media_type']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>