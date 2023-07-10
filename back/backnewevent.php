<?php require_once '../config/function.php';
require_once '../config/fonctionMod.php';

//TODO prevoir dans la table une page qui s'afficchera si ils supprime tous les events
$table="content";
$idTable="id_content";
$idD=isset($_GET['id']) ? $_GET['id'] : '';
//TODO
$tableE="event";
$idTableE="id_event";
$idE=isset($_GET['idE']) ? $_GET['idE'] : '';
//echo $idE;
//die('r');
//TODO
$tableM="media";
$idTableM="id_media";
$idM=isset($_GET['idM']) ? $_GET['idM'] : '';

$page='backnewevent.php';
$errorI='';
$errorD='';

/*On peut supprimer */
Delete($table,$idTable,$idD,$page);
//TODO
Delete($tableE,$idTableE,$idE,$page);
Delete($tableM,$idTableM,$idM,$page);

$errorD .=Delete($table,$idTable,$idD,$page);
$errorD .=Delete($tableM,$idTableM,$idM,$page);
$errorD .=Delete($tableE,$idTableE,$idE,$page);

/////////////////

if (isset($_GET['id'])) {
    /*echo 'id e '.$_REQUEST['id'];
    echo 'id m '.$_REQUEST['idM'];
    echo 'id e '.$_REQUEST['idE'];
    echo $_REQUEST['start_date'];
    echo $_REQUEST['end_date'];
    var_dump($_REQUEST);*/
    if(isset($_REQUEST['start_date'])
    && isset($_REQUEST['end_date']) &&
    isset($_REQUEST['description_content'])
    && isset($_REQUEST['title_content'])):

        execute("UPDATE event SET start_date_event=:dateStart,end_date_event=:dateEnd WHERE id_event=:id", array(
                    ':id' => $_REQUEST['idE'],
                    ':dateStart' => $_REQUEST['start_date'],
                    ':dateEnd' => $_REQUEST['end_date']
        ));

        execute("UPDATE content SET title_content=:title_content,description_content=:description_content WHERE id_content=:id", array(
                ':id' => $_REQUEST['id'],
                ':title_content' => trim(htmlspecialchars($_REQUEST['title_content'])),
                ':description_content' => trim(htmlspecialchars($_REQUEST['description_content']))
        ));
        if(!empty($_FILES['photoEvent']['name'])){
                // on renomme la photo
                $picture=uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['photoEvent']['name'];
                // on la copie dans le dossier d'img
                copy($_FILES['photoEvent']['tmp_name'],'../assets/img/'.$picture);
                //on insert dans la table media
                execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,4,:id_media_type)", array(
                    ':title_media' => 'Photo de l\'event',
                    ':name_media' => $picture,
                    ':id_media_type' => 3
                ));
        }
        //debug($_FILES);
        //die();
        messageSession($page);
    endif;

}// fin du update/**/


////////////////

$contents = execute("SELECT start_date_event,end_date_event, event.id_event AS idE, event_content.id_media AS idM,content.id_content AS id, title_content, description_content, content.id_page
FROM event
INNER JOIN event_content
ON event_content.id_event=event.id_event
INNER JOIN content
ON content.id_content=event_content.id_content GROUP BY event.id_event")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {
    $datas = execute("SELECT start_date_event,end_date_event, event.id_event AS idE, media.id_media AS idM,content.id_content, title_content, description_content, content.id_page,title_media,name_media
    FROM event
    INNER JOIN event_content
    ON event_content.id_event=event.id_event
    INNER JOIN content
    ON content.id_content=event_content.id_content
    INNER JOIN page
    ON page.id_page=content.id_page
    INNER JOIN media
    ON page.id_page=media.id_page
    WHERE content.id_content=:id AND media.id_media=:idM",array(
        ':id'=>$_GET['id'],
        ':idM'=>$_GET['idM']
    ))->fetchAll(PDO::FETCH_ASSOC);
}


if (!empty($_POST) && empty($_POST['id_event'])) {

//Si on obtient un fichier
if (!empty($_FILES) && isset($_FILES['photoEvent'])){
    $fileImg=$_FILES['photoEvent'];
    errorImg($fileImg);
    $errorI=errorImg($fileImg);
}//fin de si on obtient le fichier

 //TODO
if (empty($_POST['title_content']) && empty($_POST['description_content'])){

    $error = '<p>Ce champs est obligatoire</p>';
}/**/
    if (!isset($error)) {

        if (!isset($_GET['id']) && errorImg($fileImg)==NULL) {
            
                    // on renomme la photo
                    $picture=uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['photoEvent']['name'];
                    // on la copie dans le dossier d'img
                    copy($_FILES['photoEvent']['tmp_name'],'../assets/img/'.$picture);


                    //On insert dans les tables
                    execute("INSERT INTO event(start_date_event,end_date_event) VALUES (:dateStart,:dateEnd)", array(
                        ':dateStart' => $_POST['start_date'],
                        ':dateEnd' => $_POST['end_date']
                    ));
                    execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,4,:id_media_type)", array(
                        ':title_media' => 'Photo de l\'event',
                        ':name_media' => $picture,
                        ':id_media_type' => 3
                    ));
                    execute("INSERT INTO content (title_content,description_content,id_page) VALUES (:title_content,:description_content,:id_page)", array(
                        ':title_content' => trim(htmlspecialchars($_POST['title_content'])),
                        ':description_content' => trim(htmlspecialchars($_POST['description_content'])),
                        ':id_page' => 4
                    ));
                    //TODO insert l'event

                    //on demande les derniers ids
                    $last_id_content=execute("SELECT id_content FROM content ORDER BY id_content DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                    $last_id_media=execute("SELECT id_media FROM media ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                    $last_id_event=execute("SELECT id_event FROM event ORDER BY id_event DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);

                   //On insert dans la table intermediaire
                    execute("INSERT INTO event_content (id_event,id_content,id_media) VALUES (:id_event,:id_content,:id_media)", array(
                        ':id_media' => $last_id_media['id_media'],
                        ':id_content' => $last_id_content['id_content'],
                        ':id_event' => $last_id_event['id_event']
                    ));

                    messageSession($page);
            
        }// fin soumission en insert/**/
        
    }// fin si pas d'erreur/**/
}//Si $_POST
require_once '../inc/backheader.inc.php';
?>

<h2>New event</h2>
<?php $m=!empty($errorD) ? '<p class="text-danger">'.var_dump($errorD).'</p>' : '';
echo $m;?>
<?php 
if(isset($_GET['a']) && $_GET['a'] == 'edit'):
    foreach ($datas as $data):
?>
<figure>
    <img alt="Vignette" src="../assets/img/<?= $data['name_media']; ?>" width="300px"></td>
</figure>
<?php endforeach;
endif; ?>
    <form enctype="multipart/form-data" action="" method="post" class="w-75 mx-auto mt-5 mb-5">
            <div class="form-group">
            <span><small class="text-danger">*</small>
            <label for="start date" class="form-label"><?php
            if(isset($_GET['idE'])){
                echo 'Début : '.$data['start_date_event'];
            }else{
            echo 'Date de début';
            }
            ?></label>
            <!--<input min="<? //echo date('Y-m-d H:i:s');?>" name="start_date" id="start_date" type="datetime-local"
            value="<? //echo $data['start_date_event'] ?? ''; ?>" class="form-control">-->
            <input min="<?=date('Y-m-d');?>" name="start_date" type="date"
            value="<?=$data['start_date_event'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small><br>
            <small class="text-danger">*</small>
            <label for="end date" class="form-label">
        <?php
            if(isset($_GET['id'])){
                echo 'Fin : '.$data['end_date_event'];
            }else{
                echo 'Date de fin';}
        ?></label>
            <!--<input min="<? //echo date('Y-m-d H:i:s');?>" name="end_date" id="en_date" placeholder="Date de fin" type="datetime-local" value="<? //echo $data['end_date_event'] ?? ''; ?>" class="form-control">-->
            <input min="<?=date('Y-m-d');?>" name="end_date" placeholder="Date de fin" type="date" value="<?=$data['end_date_event'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
            </span>

            <small class="text-danger">*</small>
            <label for="content" class="form-label">Titre:</label>
            <input name="title_content" id="content" placeholder="Titre" type="text"
                   value="<?php $a=isset($_GET['a']) && $_GET['a'] == 'edit'? $data['title_content'] : '';
                   echo $a;?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>

            <small class="text-danger">*</small>
            <label for="photoEvent" class="form-label">Photo</label>
            <input name="photoEvent" type="file" class="form-control">
            <?php if(!isset($_GET['a'])):?>
            <input type="hidden" name="photoEvent2" value="<?php echo $data['name_media'];?>">
            <?php endif; ?>
            <small class="text-danger"><?= $error ?? ''; ?></small>
            <small class="text-danger">
            <?php $m=!empty($errorI) ? '<p class="text-danger">'.$errorI.'</p>' : '';
            echo $m;?></small>
            
            <textarea class="form-control" rows="4" cols="25" name="description_content" id="description_content" placeholder="Texte" style="max-height:550px;min-height:250px"
                   value="<?php $d=isset($_GET['a']) && $_GET['a'] == 'edit'? $data['description_content'] : '';
                   echo $d;?>" class="form-control"><?php $k=isset($_GET['a']) && $_GET['a'] == 'edit'? $data['description_content'] : '';
                   echo $k;?></textarea>
            <small class="text-danger"><?= $error ?? ''; ?></small>
            
        </div>
        <input type="hidden" name="id_content" value="<?php $d=isset($_GET['a']) && $_GET['a'] == 'edit'? $data['id_content'] : '';
                   echo $d;?>">
        <input type="hidden" name="id_media" value="<?php $y=isset($_GET['idM']) ? $_GET['idM'] : '';
                   echo $y;?>">
        <input type="hidden" name="id_event" value="<?php $t=isset($_GET['idE']) ? $_GET['idE'] : ''; 
         echo $t; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Image</th>
            <th>Date du lancement</th>
            <th>Date de fin</th>
            <th>Titre</th>
            <th>Texte</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contents as $content):
            
            $imgs = execute("SELECT event_content.id_event,title_media,name_media, media.id_media AS idM
            FROM event
            INNER JOIN event_content
            ON event_content.id_event=event.id_event
            INNER JOIN media
            ON media.id_media=event_content.id_media WHERE event_content.id_event=:idE",array(
                ':idE'=>$content['idE']
            ))->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <?php foreach ($imgs as $img):
                $imgEvent=$img['idM'];
                global $imgEvent;
                ?>
                <td><img alt="Vignette" src="../assets/img/<?= $img['name_media']; ?>" width="100px"></td>
                <?php endforeach;?>
                <td><?= $content['start_date_event']; ?></td>
                <td><?= $content['end_date_event']; ?></td>
                <td><?= $content['title_content']; ?></td>
                <td><?= $content['description_content']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $content['id']; ?>&idE=<?= $content['idE']; ?>&idM=<?= $imgEvent; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $content['id']; ?>&idE=<?= $content['idE']; ?>&idM=<?= $imgEvent; ?>&a=del" onclick="return confirm('Etes-vous sûr?')" class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>