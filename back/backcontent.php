<?php require_once '../config/function.php';
require_once '../config/fonctionMod.php';

$table="content";
$idTable="id_content";
$page='backcontent.php';
$idD=isset($_GET['id']) ? $_GET['id'] : '';

$contents = execute("SELECT id_content, title_content, description_content, content.id_page,title_page
FROM content
LEFT JOIN page
ON page.id_page=content.id_page")->fetchAll(PDO::FETCH_ASSOC);

$pages = execute("SELECT * FROM page GROUP BY id_page")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $content2 = execute("SELECT id_content, title_content, description_content, content.id_page AS idPage,title_page
    FROM content
    LEFT JOIN page
    ON page.id_page=content.id_page WHERE id_content=:id", array(   
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

Delete($table,$idTable,$idD,$page);

if (!empty($_POST)) {
    //TODO
    if (empty($_POST['title_content']) && empty($_POST['description_content'])){

            $error = '<p>Ce champs est obligatoire</p>';
    }

    if (!isset($error)) {

        if (empty($_POST['id_content']) && empty($_POST['id_page2'])) {

            /*NB: On ne peut pas demander cette condition plus haut
            en effet il est autorisé de ne pas obtenir l'id de la page via
            le select car dans ce cas, on prend celui de l'input hidden.
            Ici on ne peut pas empecher une tentative d'insertion sans l'id_page avant. */
            if (empty($_POST['id_page1'])){

                $error = '<p>Ce champs est obligatoire</p>';
    
            }else{

                execute("INSERT INTO content (title_content,description_content,id_page) VALUES (:title_content,:description_content,:id_page)", array(
                    ':title_content' => trim(htmlspecialchars($_POST['title_content'])),
                    ':description_content' => trim(htmlspecialchars($_POST['description_content'])),
                    ':id_page' => trim(htmlspecialchars($_POST['id_page1']))
                ));

                messageSession($page);
            }
        }// fin soumission en insert
        else {
                $idPage = $_POST['id_page1'] ? $_POST['id_page1'] : $_POST['id_page2'];

                execute("UPDATE content SET title_content=:title,description_content=:description_content,id_page=:id_page WHERE id_content=:id", array(
                    ':id' => trim(htmlspecialchars($_POST['id_content'])),
                    ':title' => trim(htmlspecialchars($_POST['title_content'])),
                    ':description_content' => trim(htmlspecialchars($_POST['description_content'])),
                    ':id_page' => trim(htmlspecialchars($idPage))
                ));

                messageSession($page);

        }// fin soumission modification
    }// fin si pas d'erreur

}// fin !empty $_POST
require_once '../inc/backheader.inc.php';
?>

<h2>CONTENT</h2>
<p class="text-danger">ATTENTION ! LES MODIFICATIONS ET LES SUPPRESSIONS PEUVENT CASSER VOTRE SITE !</p>

    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <label for="page" class="form-label">
                <?php 
                    if(isset($_GET['id'])){
                        echo 'Page: '.$content2['title_page'];
                    }else{
                        echo 'Page:';}
                ?>
            </label>
            <select class="custom-select" name="id_page1">
                <option selected value="">
                    Choisir une page *
                </option>
                <?php foreach ($pages as $page): ?>
                    <option value="<?=$page['id_page'] ?? '';?>"><?=$page['title_page'];?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="id_page2" value="<?=$content2['idPage'] ?? ''; ?>">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <small class="text-danger">*</small>
            <label for="content" class="form-label">Titre:</label>
            <input name="title_content" id="content" placeholder="Titre" type="text"
                   value="<?= $content2['title_content'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <small class="text-danger">*</small>
            <label for="content" class="form-label">Texte:</label>
            <textarea class="form-control" rows="4" cols="25" name="description_content" id="description_content" placeholder="Texte" style="max-height:550px;min-height:250px"
                   value="<?= $content2['description_content'] ?? ''; ?>" class="form-control"><?= $content2['description_content'] ?? ''; ?></textarea>
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input type="hidden" name="id_content" value="<?= $content2['id_content'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
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