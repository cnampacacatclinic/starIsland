<?php require_once '../config/function.php';
if (!empty($_POST)) {


    if (empty($_POST['nickname_team']) && empty($_POST['role_team'])) {

        $error = 'Ce champs est obligatoire';

    }

    if (!isset($error)) {

        if (empty($_POST['id_team'])) {


            execute("INSERT INTO team (nickname_team) VALUES (:nickname_team)", array(
                ':nickname_team' => $_POST['nickname_team']
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe ajouté';
            header('location:./backteam.php');
            exit();
        }// fin soumission en insert
        else {

            execute("UPDATE team SET nickname_team=:nickname_team WHERE id_team=:id", array(
                ':id' => $_POST['id_team'],
                ':nickname_team' => $_POST['nickname_team']
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe modifié';
            header('location:./backteam.php');
            exit();


        }// fin soumission modification
    }// fin si pas d'erreur

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
    <form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
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
            <small class="text-danger"><?= $avatar ?? ""; ?></small>
            <input type="hidden" name="name_media" value="<?= $team['name_media'];?>">

            <label for="team" class="form-label">Réseau / lien externe</label>
            <input name="nickname_team" id="nicknameTeam" placeholder="https://etc.." type="text"
                   value="<?= $team['nickname_team'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>

            <label for="team" class="form-label">Type de réseau</label>
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