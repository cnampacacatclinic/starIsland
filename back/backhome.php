<?php /*/////////////////////////////////
* Catherine Jules
* Date : Juin / Juillet 2023
* TP pour SIMPLON
* CDA
* NB: Le TP est en PHP procédural 
car c'était demandé pour cet
exercice.
/////////////////////////////////*/
$ph='backhome';
$idD=isset($_GET['id']) ? $_GET['id'] : '';

$contents = execute("SELECT id_content, title_content, description_content, content.id_page,title_page
FROM content
LEFT JOIN page
ON page.id_page=content.id_page WHERE content.id_page=1")->fetchAll(PDO::FETCH_ASSOC);

//$pageVIP = execute("SELECT * FROM page WHERE id_page=1")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $content2 = execute("SELECT id_content, title_content, description_content, content.id_page AS idPage,title_page
    FROM content
    LEFT JOIN page
    ON page.id_page=content.id_page WHERE id_content=:id", array(   
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_POST)) {
    //TODO
    if (empty($_POST['title_content']) && empty($_POST['description_content'])){

            $error = '<p>Ce champs est obligatoire</p>';
    }

    if (!isset($error)) {

                execute("UPDATE content SET title_content=:title,description_content=:description_content,id_page=:id_page WHERE id_content=:id", array(
                    ':id' => trim(htmlspecialchars($_POST['id_content'])),
                    ':title' => trim(htmlspecialchars($_POST['title_content'])),
                    ':description_content' => trim(htmlspecialchars($_POST['description_content'])),
                    ':id_page' => 1
                ));

                messageSession($ph);

    }// fin si pas d'erreur

}// fin !empty $_POST
require_once '../inc/backheader.inc.php';
?>

<h2>Page d'acceuil</h2>
<?php if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit'):?>
    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
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
<?php endif; ?>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Titre du contenu</th>
            <th>Texte du contenu</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contents as $content): ?>
            <tr>
                <td><?= htmlspecialchars_decode($content['title_content']); ?></td>
                <td><?= htmlspecialchars_decode($content['description_content']); ?></td>
                <td class="text-center">
                    <a href="?p=<?= $ph; ?>&id=<?= $content['id_content']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>