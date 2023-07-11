<?php /*/////////////////////////////////
* Catherine Jules
* Date : Juin / Juillet 2023
* TP pour SIMPLON
* CDA
* NB: Le TP est en PHP procédural 
car c'était demandé pour cet
exercice.
/////////////////////////////////*/

$table="comment";
$page="backcomment";
$condition="id_comment";
$idD=isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($_GET)) {

    if (isset(($_GET['e']))) {
     
    $actived=$_GET['e']==1 ? 0 : 1;

    execute("UPDATE comment SET activated=:activated WHERE id_comment=:id",array(
        ':activated'=>$actived,
        ':id'=>$idD
    ));

    messageSession($page);
 
    }//fin de isset($activated)
}// fin !empty $_GET

$datas = execute("SELECT * FROM comment")->fetchAll(PDO::FETCH_ASSOC);

Delete($table,$condition,$idD,$page);


require_once '../inc/backheader.inc.php';
?>
<h2>Comment</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Nickname</th>
            <th>Note</th>
            <th>Date</th>
            <th>Comment</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($datas as $data): ?>
            <tr>
                <td><?= $data['nickname_comment']; ?></td>
                <td><?= $data['rating_comment']; ?>/5</td>
                <td><?= $data['publish_date_comment']; ?></td>
                <td><?= $data['comment_text']; ?></td>
                <td class="text-center">
                    <a href="?p=<?= $page; ?>&id=<?= $data['id_comment']; ?>&a=edit&e=<?=$data['activated'];?>" class="btn btn-outline-info">
                    <?php
                    if($data['activated']==1){
                        echo 'Désactiver';
                    }else{
                        echo 'Activer';
                    }
                    ?>
                    </a>
                    <a href="?p=<?= $page; ?>&id=<?= $data['id_comment']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>