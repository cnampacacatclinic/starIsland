<?php require_once '../config/function.php';
if (!empty($_GET)) {


    if (isset(($_GET['e']))) {
    /* Pour un peu plus de securite, on prevoit que si
    l'utilisateur met une autre valeur en get (par exemple le chiffre 4)
    de toute façon ce $_GET vaudra 0 */
       $activated=$_GET['e']==0 ? 1 : 0;
            execute("UPDATE comment SET activated=:activated WHERE id_comment=:id", array(
                ':id' => $_GET['id'],
                ':activated' => $activated
            ));

            $_SESSION['messages']['success'][] = 'Activation modifiée'.$activated;
            header('location:./backcomment.php');
            exit();
 
    }//fin de isset($activated)
}// fin !empty $_GET

$comments = execute("SELECT * FROM comment")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $comment = execute("SELECT * FROM comment WHERE id_comment=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {

    $success = execute("DELETE FROM comment WHERE id_comment=:id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = '<p>Commentaire supprimé</p>';
        header('location:./backcomment.php');
        exit;

    } else {
        $_SESSION['messages']['danger'][] = '<p>Problème de traitement, veuillez réitérer</p>';
        header('location:./backcomment.php');
        exit;
    }

}


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
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment['nickname_comment']; ?></td>
                <td><?= $comment['rating_comment']; ?>/5</td>
                <td><?= $comment['publish_date_comment']; ?></td>
                <td><?= $comment['comment_text']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $comment['id_comment']; ?>&a=edit&e=<?=$comment['activated'];?>" class="btn btn-outline-info">
                    <?php
                    if($comment['activated']==1){
                        echo 'Désactiver';
                    }else{
                        echo 'Activer';
                    }
                    ?>
                    </a>
                    <a href="?id=<?= $comment['id_comment']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>