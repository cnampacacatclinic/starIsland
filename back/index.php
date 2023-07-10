<?php     require_once '../config/function.php';
require_once '../config/fonctionMod.php';
 /* si on est connecté */
if (isset($_GET['a']) && $_GET['a']=='dis'){

    unset($_SESSION['user']);
    $_SESSION['messages']['info'][]='A bientôt !!';
    header('location:./');
    exit();
}

//si on n'a pas reçu une demande de page en get
$p= !empty($_GET['p']) ? $_GET['p'] :'';


debug($_POST);
if (!empty($_REQUEST)){
    $emailM= isset($_REQUEST['email_connexion']) ? htmlspecialchars(trim($_REQUEST['email_connexion'])) : '';
    $MDP= isset($_REQUEST['password']) ? htmlspecialchars(trim($_REQUEST['password'])) : '';

    if (empty($emailM)) {
        $email='Email obligatoire';
        $error=true;
///////////section message c'est vide lien vers le formulaire
        echo $email;
    
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
                $hello= $_SESSION['messages']['success'][]="Bienvenue !";
                echo $hello;
    
            }else{
                $password='Erreur sur le mot de passe';
                ///////////section Erreur sur le mot de passe lien vers le formulaire
                echo $password;
            }
    
    
    
        }else{
          $email='Aucun compte existant à cette adresse mail';
          echo $email;
          ///////////section Aucun compte existant à cette adresse mail lien vers le formulaire
        }
    }
}else{
    echo 'Vous n\'êtes pas connecté!';
}  

if(connect()==false):
    header('location:'. BASE_PATH.'/?page=dis');
else :

    if($p!=='backteam'){
        require_once '../inc/backheader.inc.php';
    }

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
    $_GET['page'] ='';
}


 require_once '../inc/backfooter.inc.php';
 
 endif;?>