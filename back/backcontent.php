<?php require_once '../config/function.php';

$contents = execute("SELECT id_content, title_content, description_content, content.id_page,title_page
FROM content
LEFT JOIN page
ON page.id_page=content.id_page")->fetchAll(PDO::FETCH_ASSOC);

$pages = execute("SELECT * FROM page GROUP BY id_page")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    //$content2 = execute("SELECT * FROM content WHERE id_content=:id", array(
    $content2 = execute("SELECT id_content, title_content, description_content, content.id_page AS idPage,title_page
    FROM content
    LEFT JOIN page
    ON page.id_page=content.id_page WHERE id_content=:id", array(   
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);


}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {

    $success = execute("DELETE FROM content WHERE id_content=:id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'page supprimée';
        header('location:./backcontent.php');
        exit;

    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location:./backcontent.php');
        exit;


    }

}

if (!empty($_POST)) {

    if (empty($_POST['title_content']) || empty($_POST['description_content']) || empty($_POST['id_page'])) {

        $error = 'Ce champs est obligatoire';

    }

    if (!isset($error)) {

        if (empty($_POST['id_content'])) {


            execute("INSERT INTO content (title_content,description_content,id_page) VALUES (:title_content,:description_content,:id_page)", array(
                ':title_content' => $_POST['title_content'],
                ':description_content' => $_POST['description_content'],
                ':id_page' => $_POST['id_page']
            ));

            $_SESSION['messages']['success'][] = 'Le contenu a été ajouté';
            header('location:./backcontent.php');
            exit();
        }// fin soumission en insert
        else {
            //TODO 14
            if(isset($_POST['id_page1'])){
                $idPage = $_POST['id_page2'];

            
                execute("UPDATE content SET title_content=:title,description_content=:description_content,id_page=:id_page WHERE id_content=:id", array(
                    ':id' => $_POST['id_content'],
                    ':title' => $_POST['title_content'],
                    ':description_content' => $_POST['description_content'],
                    ':id_page' => $_POST['id_page']
                ));

                $_SESSION['messages']['success'][] = 'Le contenu a été modifié';
                header('location:./backcontent.php');
                exit();
            }

        }// fin soumission modification
    }// fin si pas d'erreur

}// fin !empty $_POST
require_once '../inc/backheader.inc.php';
?>

<h2>CONTENT</h2>
<p class="text-danger">ATTENTION ! LES MODIFICATIONS ET LES SUPPRESSIONS PEUVENT CASSER VOTRE SITE !</p>

    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <select class="form-select" name="id_page1" required>
                <option selected>
                    Choisir une page *
                </option>
                <?php foreach ($pages as $page): ?>
                    <option value="<?=$page['id_page'] ?? '';?>"><?=$page['title_page'];?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="id_page2" value="<?$content2['idPage'] ?? ''; ?>">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <small class="text-danger">*</small>
            <label for="content" class="form-label">Titre</label>
            <input name="title_content" id="content" placeholder="Titre" type="text"
                   value="<?= $content2['title_content'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <small class="text-danger">*</small>
            <label for="content" class="form-label">Texte</label>
            <textarea class="form-control" rows="4" cols="25" name="description_content" id="description_content" placeholder="Texte"
                   value="<?= $content2['description_content'] ?? ''; ?>" class="form-control"><?= $content2['description_content'] ?? ''; ?></textarea>
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input type="hidden" name="id_content" value="<?= $content2['id_content'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-dark table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Nom de la Page</th>
            <th>Titre du contenu</th>
            <th>Texte du contenu</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contents as $content): ?>
            <tr>
                <td><?= $content['title_page']; ?></td>
                <td><?= $content['title_content']; ?></td>
                <td><?= $content['description_content']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $content['id_content']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $content['id_content']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>