<?php require_once '../config/function.php';
if (!empty($_POST)) {

    /* Les données obligatoires */
    if (empty($_POST['nickname_team']) && empty($_POST['role_team'])) {

        $error = 'Ce champs est obligatoire';

    }

    if (!isset($error)) {

        if (empty($_POST['id_team'])) {

            execute("INSERT INTO team (nickname_team,role_team) VALUES (:nickname_team,:role_team)", array(
                ':nickname_team' => $_POST['nickname_team']
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe ajouté';
            header('location:./backteam.php');
            exit();
        }// fin soumission en insert
        else {
            //ajout du role et du pseudo
            execute("UPDATE team SET nickname_team=:nickname_team,role_team=:role_team WHERE id_team=:id", array(
                ':id' => $_POST['id_team'],
                ':nickname_team' => $_POST['nickname_team'],
                ':role_team' => $_POST['role_team']
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe modifié';
            header('location:./backteam.php');
            exit();

        }// fin soumission modification
    }// fin si pas d'erreur


    /*Les données qui ne sont pas obligatoires
    * comme par exemple les reseaux sociaux et l'avatar qui 
    * peut être renseigner par defaut si on n'a pas d'image sous la main*/
    
    //ajout du media
    if(!empty($_POST['name_media'])){
        execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,2,1)", array(
            ':title_media' => $_POST['title_media'],
            ':name_media' => $_POST[':name_media']
        ));
        //TODO last insert id
        execute("INSERT INTO team_media(id_media,id_team) VALUES ('[value-1]','[value-2]')", array(
            ':id_team' => $_POST['id_team'],
            ':id_media' => $_POST['id_media']
        ));
    }

    //ajout de l'image


}// fin !empty $_POST

$teams = execute("SELECT * FROM team")->fetchAll(PDO::FETCH_ASSOC);


if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $team = execute("SELECT * FROM team WHERE id_team=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {

    $success = execute("DELETE FROM team WHERE id_team=:id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Membre supprimé';
        header('location:./backteam.php');
        exit;

    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location:./backteam.php');
        exit;
    }
}


require_once '../inc/backheader.inc.php';
?>

<h2>TEAM</h2>
    <form enctype="multipart/form-data" action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="team" class="form-label">Nickname</label>
            <input name="nickname_team" id="nicknameTeam" placeholder="Nickname" type="text"
                   value="<?= $team['nickname_team'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>

            <small class="text-danger">*</small>
            <label for="team" class="form-label">Role</label>
            <input name="role" id="roleTeam" placeholder="Role" type="text"
                   value="<?= $team['role_team'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>

            <label for="avatar" class="form-label">Avatar</label>
            <input name="avatar" type="file" class="form-control" id="avatar">
            <!-- TODO avatar requete imgTeam -->
            <input type="hidden" name="avatar2" value="<?= $team['imgTeam'] ?? 'avatar-1.png';?>">

            <label for="lien" class="form-label">Réseau / lien externe</label>
            <input name="name_media" id="name_media" placeholder="https://etc.." type="url"
                   value="<?= $team['name_media'] ?? ''; ?>" class="form-control">

            <label for="reseau" class="form-label">Type de réseau</label>
            <select class="custom-select" name="title_media">
                <option selected value="">
                    Choisir
                </option>
                <option value="discord">Discord</option>
                <option value="youtube">Youtube</option>
                <option value="facebook">Facebook</option>
                <option value="twitch">Twitch</option>
                <option value="instragram">Instragram</option>
                <option value="twitter">Twitter</option>
                <option value="autre">Autre</option>
            </select>

        </div>
        <input type="hidden" name="id_team" value="<?= $team['id_team'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Nickname</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teams as $team): ?>
            <tr>
                <td><?= $team['nickname_team']; ?></td>
                <td><?= $team['role_team']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $team['id_team']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $team['id_team']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>