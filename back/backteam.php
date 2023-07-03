<?php require_once '../config/function.php';

if (!empty($_POST)) {
 
    //debug($_FILES);
    //  die();

    /*DONNEES OBLIGATOIRES*/
    if (empty($_POST['nickname_team']) && empty($_POST['role_team'])) {

        $error = 'Ce champs est obligatoire';
    }


    if (!isset($error)) {
        if (empty($_GET['id'])) {
            //ajout du role et du pseudo
            execute("INSERT INTO team (nickname_team,role_team) VALUES (:nickname_team,:role_team)", array(
                ':nickname_team' => trim(htmlspecialchars($_POST['nickname_team'])),
                ':role_team' => trim(htmlspecialchars($_POST['role']))
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe ajouté';
        }// fin soumission en insert
        else {
            //modification du role et du pseudo
            execute("UPDATE team SET nickname_team=:nickname_team,role_team=:role_team WHERE id_team=:id", array(
                ':id' => $_POST['id_team'],
                ':nickname_team' => $_POST['nickname_team'],
                ':role_team' => $_POST['role']
            ));

            $_SESSION['messages']['success'][] = 'Membre de l\'équipe modifié';

        }// fin soumission modification
        
        /*DONNEES QUI NE SONT PAS OBLIGATOIRES*/
        
        //si on  a le media
        if(!empty($_POST['name_media'])){
            $nameMedia=$_POST['name_media'];
            $idMediaType= 1;

            execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,2,:id_media_type)", array(
                ':title_media' => trim(htmlspecialchars($_POST['title_media'])),
                ':name_media' => trim(htmlspecialchars($nameMedia)),
                ':id_media_type' => $idMediaType
            ));

            //On insert les derniers id dans la table relationnelle
            $last_id_team=execute("SELECT id_team FROM team ORDER BY id_team DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
            $last_id_media=execute("SELECT id_media FROM media ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
            
            execute("INSERT INTO team_media(id_media,id_team) VALUES (:id_team,:id_media)", array(
                        ':id_team' => $last_id_team['id_team'],
                        ':id_media' => $last_id_media['id_media']
            ));
        }

        //si on a l'image
        //if(!empty($_FILES['avatar']['name']))
        if(!empty($_FILES)){
            
            $avatar_title_media='Portrait de '.trim(htmlspecialchars($_POST['nickname_team'])).' membre de la team';

            //TODO
            //(!isset($errorImg))


            /*
            //on verifie le format du fichier
if (!empty($_FILES['avatar']['name'])){
          
        $errorImg="";
        $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];
        if (!in_array($_FILES['avatar']['type'],$formats )){
            $errorImg.="Les formats d'image autorisés sont: les png, les jpg et les webp'<br>";

//On verifie la taille du fichier
if ($_FILES['avatar']['size'] > 2000000){
            $errorImg.="Taille maximale autorisée de 2M";
}
}
            */

            if(!empty($_FILES['avatar']['name'])){
                // on renomme la photo
                $picture='avatar/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['avatar']['name'];
                // on la copie dans le dossier d'avatar
                copy($_FILES['avatar']['tmp_name'],'../assets/'.$picture);

                execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,2,:id_media_type)", array(
                    ':title_media' => $avatar_title_media,
                    ':name_media' => $picture,
                    ':id_media_type' => 2
                ));

                //On insert les derniers id dans la table relationnelle
                //LAST INSERT ID ne fonctionne pas
                $last_id_team=0;
                $last_id_media=0;
                $last_id_team=execute("SELECT id_team FROM team ORDER BY id_team DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                $last_id_media=execute("SELECT id_media FROM media ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                /*debug($last_id_media);
                echo $last_id_team['id_team'];
                debug($last_id_team);
                echo $last_id_media['id_media'];
                die();*/
                execute("INSERT INTO team_media(id_media,id_team) VALUES (:id_team,:id_media)", array(
                            ':id_team' => $last_id_team['id_team'],
                            ':id_media' => $last_id_media['id_media']
                        ));
            }
        }

        header('location:./backteam.php');
        exit();
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