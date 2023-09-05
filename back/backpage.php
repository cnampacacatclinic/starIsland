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
$table="page";
$idTable="id_page";
$pp="backpage";
$idD=isset($_GET['id']) ? $_GET['id'] : '';

Delete($table,$idTable,$idD,$pp);
$errorD =Delete($table,$idTable,$idD,$pp);

if (!empty($_POST)) {
    if (empty($_POST['title_page']) || empty($_POST['url'])) {
        $error = 'Ce champs est obligatoire';
    }

    if (!isset($error)) {
        if (empty($_POST['id_page'])) {
            execute("INSERT INTO page (title_page,url) VALUES (:title_page,:urlPage)", array(
                ':title_page' => trim(htmlspecialchars($_POST['title_page'])),
                ':urlPage' => trim(htmlspecialchars($_POST['url']))
            ));

            messageSession($pp);

        }// fin soumission en insert
        else {
            execute("UPDATE page SET title_page=:title, url=:urlPage WHERE id_page=:id", array(
                ':id' => $_POST['id_page'],
                ':title' => trim(htmlspecialchars($_POST['title_page'])),
                ':urlPage' => trim(htmlspecialchars($_POST['url']))
            ));

            messageSession($pp);
            
        }// fin soumission modification
    }// fin si pas d'erreur

}// fin !empty $_POST

$pages= execute("SELECT * FROM page")->fetchAll(PDO::FETCH_ASSOC);
if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {
    $page = execute("SELECT * FROM page WHERE id_page=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

//Obligé de mettre la nav ici à cause de l'header location
require_once '../inc/backheader.inc.php';
?>

<h2>PAGE</h2>
<p class="text-danger">ATTENTION ! LES MODIFICATIONS ET LES SUPPRESSIONS PEUVENT CASSER VOTRE SITE !</p>
<?php $m=!empty($errorD) ? '<p class="text-danger">'.var_dump($errorD).'</p>' : '';
echo $m;?>
<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="page" class="form-label">Nom de la page</label>
            <input name="title_page" id="page" placeholder="Nom de la page"  type="text"
                   value="<?= $page['title_page'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <label for="page" class="form-label">Chemin de la page</label>
            <p>NB : Il ne s'agit pas d'une URL à proprement parler mais d'un nom 
                qui servira pour nommer le chemin vers la page.
            </p>
            <input name="url" id="page" placeholder="Chemin de la page" type="text"
                   value="<?= $page['url'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input  type="hidden" name="id_page" value="<?= $page['id_page'] ?? ''; ?>">
        <button  type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Titre</th>
            <th>URL</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pages  as $page): ?>
            <tr>
                <td><?= $page['title_page']; ?></td>
                <td><?= $page['url']; ?></td>
                <td class="text-center">
                    <a href="?p=<?= $pp; ?>&id=<?= $page['id_page']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?p=<?= $pp; ?>&id=<?= $page['id_page']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>