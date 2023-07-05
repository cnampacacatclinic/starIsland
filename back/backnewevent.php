<?php require_once '../config/function.php';
require_once '../config/fonctionMod.php';
//TODO prevoir dans la table une page qui s'afficchera si ils supprime tous les events
$table="content";
$idTable="id_content";
$table2="media";
$idTable2="id_media";
$page='backnewevent.php';
$errorI='';

$contents = execute("SELECT id_content, title_content, description_content, content.id_page,title_media,name_media
FROM content
INNER JOIN page
ON page.id_page=content.id_page
INNER JOIN media
ON media.id_page=content.id_page
WHERE content.id_page=4")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

   $contents = execute("SELECT id_content, title_content, description_content, content.id_page AS idPage,title_media,name_media
    INNER JOIN page
    ON page.id_page=idPage
    INNER JOIN media
    ON media.id_page=content.id_page
    WHERE idPage=4", array(   
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

Delete($table,$idTable,$page);

if (!empty($_POST)) {
    //TODO
    if (empty($_POST['title_content']) && empty($_POST['description_content'])){

            $error = '<p>Ce champs est obligatoire</p>';
    }

    if (!isset($error)) {

        if (empty($_POST['id_content']) && empty($_POST['id_page2'])) {

        
            //Si on obtient un fichier
            if (isset($_FILES)){
                $fileImg=$_FILES['photoEvent'];
                errorImg($fileImg);
                $errorI=errorImg($fileImg);
            }//fin de si on obtient le fichier
        
            if (!isset($error) && !isset($errorImg)) {
                if(errorImg($fileImg)==NULL){
                if(!empty($_FILES['photoEvent']['name'])){
                    // on renomme la photo
                    $picture=uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['photoEvent']['name'];
                    // on la copie dans le dossier d'album
                    copy($_FILES['photoEvent']['tmp_name'],'../assets/album/'.$picture);
                    //On insert dans la table media
                    execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,6,:id_media_type)", array(
                        ':title_media' => $_POST['title_media'],
                        ':name_media' => $picture,
                        ':id_media_type' => 4
                    ));
                    execute("INSERT INTO content (title_content,description_content,id_page) VALUES (:title_content,:description_content,:id_page)", array(
                        ':title_content' => trim(htmlspecialchars($_POST['title_content'])),
                        ':description_content' => trim(htmlspecialchars($_POST['description_content'])),
                        ':id_page' => trim(htmlspecialchars($_POST['id_page1']))
                    ));
                    messageSession($page);
                }// fin soumission en insert
                else {
                    
                    execute("UPDATE media SET name_media=:name_media,title_media=:title_media WHERE id_media=:id", array(
                        ':id' => $_POST['id_media'],
                        ':name_media' => $_POST['name_media'],
                        ':title_media' => trim(htmlspecialchars($_POST['title_media']))
                    ));

                    execute("UPDATE content SET title_content=:title_content,description_content=:description_content WHERE id_content=:id", array(
                        ':id' => $_POST['id_media'],
                        ':title_content' => trim(htmlspecialchars($_POST['title_content'])),
                        ':description_content' => trim(htmlspecialchars($_POST['description_content']))
                    ));
        
                    messageSession($page);
            }// fin soumission modification/**/
            }// fin de si error n'est pas NULL/**/
            }// fin si pas d'erreur/**/
        }// fin !empty $_POST
    }
}// fin !empty $_POST
require_once '../inc/backheader.inc.php';
?>

<h2>New event</h2>
<figure>
<img alt="Vignette" src="../assets/album/<?= $content['name_media']; ?>" width="200px"></td>
</figure>
    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="content" class="form-label">Titre:</label>
            <input name="title_content" id="content" placeholder="Titre" type="text"
                   value="<?= $contents['title_content'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>

            <small class="text-danger">*</small>
            <label for="photoEvent" class="form-label">Photo</label>
            <input name="photoEvent" type="file" class="form-control" id="photoEvent">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <small class="text-danger">
            <?php $m=!empty($errorI) ? '<p class="text-danger">'.$errorI.'</p>' : '';
            echo $m;?>
            
            <textarea class="form-control" rows="4" cols="25" name="description_content" id="description_content" placeholder="Texte" style="max-height:550px;min-height:250px"
                   value="<?= $contents['description_content'] ?? ''; ?>" class="form-control"><?= $contents['description_content'] ?? ''; ?></textarea>
            <small class="text-danger"><?= $error ?? ''; ?></small>
            
        </div>
        <input type="hidden" name="id_content" value="<?= $contents['id_content'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Image</th>
            <th>Titre</th>
            <th>Texte</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contents as $content): ?>
            <tr>
                <td><img alt="Vignette" src="../assets/album/<?= $content['name_media']; ?>" width="100px"></td>
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