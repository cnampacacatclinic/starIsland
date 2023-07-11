<?php /*/////////////////////////////////
* Catherine Jules
* Date : Juin / Juillet 2023
* TP pour SIMPLON
* CDA
* NB: Le TP est en PHP procédural 
car c'était demandé pour cet
exercice.
/////////////////////////////////*/

require_once '../config/function.php';
require_once '../config/fonctionMod.php';

//si on n'a pas reçu une demande de page en get
$p= !empty($_GET['p']) ? $_GET['p'] :'';
$messageError='';

//debug($_POST);
/*if (!empty($_POST)){
    $emailM= isset($_POST['email_connexion']) ? htmlspecialchars(trim($_POST['email_connexion'])) : '';
    $MDP= isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';
    $email='Email obligatoire';
    if (empty($emailM)) {
        $messageError.='Email obligatoire';
        $error=true;
    }else{
        $user=execute("SELECT * FROM user WHERE email_user=:email",array(
            ':email'=>$emailM
        ));
        // vérification de l'existence d'un utilisateur à cette adresse mail
        if ($user->rowCount()==1){
            // verification du mot passe provenant du formulaire avec le mot de passe haché provenant de la BDD
            $user=$user->fetch(PDO::FETCH_ASSOC);
            if (password_verify($MDP, $user['password_user'])){
    
                $_SESSION['user']=$user;
                $_SESSION['messages']['success'][]='Bienvenue !';

            }else{
                $messageError.='Erreur sur le mot de passe';
            }
    
        }else{
            $messageError.='Aucun compte existant à cette adresse mail';
        }
    }
}else{

    $_SESSION['error']['danger'][]=$messageError;
    header('location:'. BASE_PATH.'/?page=dis');
}  

if(connect()==false):
    header('location:'. BASE_PATH.'/?page=dis');
else :
/**/

//Selon la demande en get on affiche le contenu choisi
switch ($p) {
    case 'backcomment':
        include 'backcomment.php';
        break;
    case 'backcontent':
        include 'backcontent.php';
        break;
    case 'backgallerie':
        include 'backgallerie.php';
        break;
    case 'backmedia':
        include 'backmedia.php';
        break;
    case 'backnewevent':
        include 'backnewevent.php';
        break;
    case 'backpage':
        include 'backpage.php';
    break;
    case 'backteam':
        include 'backteam.php';
        break;
    case 'backmediatype':
        include 'media_type.php';
        break;
    default:
    include 'backnewevent.php';
}


 require_once '../inc/backfooter.inc.php';
 
 //endif;?>