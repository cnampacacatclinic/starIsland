<?php require_once '../config/function.php';
require_once '../config/fonctionMod.php';
$result='';
$table="team";
$idTable="id_team";
$page="backteam.php";

if (!empty($_POST)) {
 
    //debug($_FILES);
    //  die();

    //Si on obtient un fichier
    if (!empty($_FILES)){
            //on verifie le format du fichier        
            $errorImg="";
            $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];
            if (!in_array($_FILES['avatar']['type'],$formats )){
            $errorImg.="Les formats d'image autorisés sont: les png, les jpg et les webp<br>";

            //On verifie la taille du fichier
            if ($_FILES['avatar']['size'] > 2000000){
                $errorImg.="La taille maximale autorisée pour le fichier, est de 2M";
            }//fin de si la taille est bonne
         }//fin de si le format est bon   
    }//fin de si on obtient le fichier


    /*DONNEES OBLIGATOIRES*/
    if (empty($_POST['nickname_team']) && empty($_POST['role_team'])) {

        $error = '<p>Ce champs est obligatoire</p>';
    }
    //lors de la première insertion la photo est obligatoire
    //Si on n'a pas la photo et qu'ii ne s'agit pas d'un modification
    if(empty($_FILES['avatar']['name']) && empty($_GET['id'])){
        $errorImg2='<p>Vous avez oublié l\'image.</p>';
    }

    if (!isset($error) || !isset($errorImg) || !isset($errorImg2) ) {

        if (empty($_GET['id'])) {
            //ajout du role et du pseudo
            execute("INSERT INTO team (nickname_team,role_team) VALUES (:nickname_team,:role_team)", array(
                ':nickname_team' => trim(htmlspecialchars($_POST['nickname_team'])),
                ':role_team' => trim(htmlspecialchars($_POST['role']))
            ));

            $_SESSION['messages']['success'][] = '<p>Membre de l\'équipe ajouté</p>';
        }// fin soumission en insert
        else {
            //modification du role et du pseudo
            execute("UPDATE team SET nickname_team=:nickname_team,role_team=:role_team WHERE id_team=:id", array(
                ':id' => $_POST['id_team'],
                ':nickname_team' => $_POST['nickname_team'],
                ':role_team' => $_POST['role']
            ));

            $_SESSION['messages']['success'][] = '<p>Membre de l\'équipe modifié</p>';

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

                if (empty($_GET['id'])) {   
                    //On insert les derniers id dans la table relationnelle
                    //LAST INSERT ID ne fonctionne pas
                    $last_id_team=execute("SELECT id_team FROM team ORDER BY id_team DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                    $last_id_media=execute("SELECT id_media FROM media ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                
                    execute("INSERT INTO team_media(id_media,id_team) VALUES (:id_media,:id_team)", array(
                                ':id_team' => $last_id_team['id_team'],
                                ':id_media' => $last_id_media['id_media']
                            ));
                }
                else{
                    $last_id_media=execute("SELECT id_media FROM media ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                    
                    execute("INSERT INTO team_media(id_media,id_team) VALUES (:id_media,:id_team)", array(
                        ':id_team' => $_GET['id'],
                        ':id_media' => $last_id_media['id_media']
                    ));
                }
            
        }

        //si on a l'image
        //if(!empty($_FILES['avatar']['name']))
        if(!empty($_FILES)){
            
            $avatar_title_media='Portrait de '.trim(htmlspecialchars($_POST['nickname_team'])).' membre de la team';
            //TODO
            //si on l'image et l'id de la personne
            if (!empty($_GET['id']) && !empty($_FILES['avatar']['name'])) {
                //on supprime l'ancien avatar dans la BDD
                execute("DELETE FROM media WHERE id_media=:idM",array(
                    ':idM'=>$_GET['im']
                ));
                //on supprime l'ancienne relation dans la BDD
                execute("DELETE FROM team_media WHERE id_media=:idM AND id_team=:id",array(
                    ':idM'=>$_GET['im'],
                    ':id'=>$_GET['id']
                ));
            }

            //Si on a la photo
            if(!empty($_FILES['avatar']['name'])){
                    // on renomme la photo
                    $picture=uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['avatar']['name'];
                    // on la copie dans le dossier d'avatar
                    copy($_FILES['avatar']['tmp_name'],'../assets/avatar/'.$picture);
                    //On insert dans la table media
                    execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,2,:id_media_type)", array(
                        ':title_media' => $avatar_title_media,
                        ':name_media' => $picture,
                        ':id_media_type' => 2
                    ));
                    //dans le cas ou c'est une première insertion et pas une modif
                    if (empty($_GET['id'])) {   
                        //On insert les derniers id dans la table relationnelle
                        //LAST INSERT ID ne fonctionne pas
                        $last_id_team=execute("SELECT id_team FROM team ORDER BY id_team DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $last_id_media=execute("SELECT id_media FROM media ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        /*debug($last_id_media);
                        echo $last_id_team['id_team'];
                        debug($last_id_team);
                        echo $last_id_media['id_media'];
                        die();*/
                        execute("INSERT INTO team_media(id_media,id_team) VALUES (:id_media,:id_team)", array(
                                    ':id_team' => $last_id_team['id_team'],
                                    ':id_media' => $last_id_media['id_media']
                                ));
                    }
                else{
                        $last_id_media=execute("SELECT id_media FROM media ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        
                        execute("INSERT INTO team_media(id_media,id_team) VALUES (:id_media,:id_team)", array(
                            ':id_team' => $_GET['id'],
                            ':id_media' => $last_id_media['id_media']
                        ));
                    }
            }//fin de si on a la photo
        
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

Delete($table,$idTable,$page);

//On est obligé de supprimer d'autres données avec d'autre identifiants
if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    //on supprime l'ancien avatar dans la BDD
    execute("DELETE FROM media WHERE id_media=:idM",array(
        ':idM'=>$_GET['im']
    ));
    //on supprime l'ancienne relation dans la BDD
    execute("DELETE FROM team_media WHERE id_media=:idM AND id_team=:id",array(
        ':idM'=>$_GET['im'],
        ':id'=>$_GET['id']
    ));
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
            <small class="text-danger"><?php
            echo $errorImg ?? '';
            echo $errorImg2 ?? '';
            if(empty($_GET['id'])){
                echo '<p>* Image obligatoire</p>';
            }
            ?></small>

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
            <th>Avatar</th>
            <th>Nickname</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teams as $team): ?>
            <tr>
            <?php
                //on demande l'avatar
                $imgAvatar = execute("SELECT media.id_media AS idMed,media.name_media AS nam FROM team
                INNER JOIN team_media
                ON team.id_team=team_media.id_team
                INNER JOIN media
                ON media.id_media=team_media.id_media
                INNER JOIN media_type
                ON media_type.id_media_type=media.id_media_type
                WHERE title_media_type='avatar' AND team.id_team=:idT ORDER BY media.id_media DESC LIMIT 1", array(
                        ':idT' => $team['id_team']
                ))->fetch(PDO::FETCH_ASSOC);
            ?>
            
                <td><img alt="Avatar" class="teamAvatar" src="../assets/avatar/<?= $imgAvatar['nam']; ?>" width="100px"></td>
                <td><?= $team['nickname_team']; ?></td>
                <td><?= $team['role_team']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $team['id_team']; ?>&im=<?= $imgAvatar['idMed']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $team['id_team']; ?>&im=<?= $imgAvatar['idMed']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>