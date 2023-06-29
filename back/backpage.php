<?php require_once '../config/function.php';?>
    <h2>PAGE</h2>
<?php
if (!empty($_POST)) {
    if (empty($_POST['title_page']) || empty($_POST['url'])) {
        $error = 'Ce champs est obligatoire';
    }

    if (!isset($error)) {
        if (empty($_POST['id_page'])) {
            execute("INSERT INTO page (title_page,url) VALUES (:title_page,:urlPage)", array(
                ':title_page' => $_POST['title_page'],
                ':urlPage' => $_POST['url']
            ));

            $_SESSION['messages']['success'][] = 'page ajoutée';
            header('location:./backpage.php');
            exit();
        }// fin soumission en insert
        else {
            execute("UPDATE page SET title_page=:title, url=:urlPage WHERE id_page=:id", array(
                ':id' => $_POST['id_page'],
                ':title' => $_POST['title_page'],
                ':urlPage' => $_POST['url']
            ));

            $_SESSION['messages']['success'][] = 'L URL est modifiée';
            header('location:./backpage.php');
            exit();
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
    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="page" class="form-label">Nom de la page</label>
            <input name="title_page" id="page" placeholder="Nom de la page"  ="text"
                   value="<?= $page['title_page'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <label for="page" class="form-label">URL de la page</label>
            <input name="url" id="page" placeholder="URL de la page"  ="text"
                   value="<?= $page['url'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input  type="hidden" name="id_page" value="<?= $page['id_page'] ?? ''; ?>">
        <button  type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-dark table-striped w-75 mx-auto">
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
                    <a href="?id=<?= $page['id_page']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php require_once '../inc/backfooter.inc.php'; ?>