<?php 
/*/////////////////////////////////
* Catherine Jules
* Date : Juin / Juillet 2023
* TP pour SIMPLON
* CDA
* NB: Le TP est en PHP procédural 
car c'était demandé pour cet
exercice.
/////////////////////////////////*/
   
/* les fonctions */
require_once 'config/function.php';

/* l'entête */
require_once 'inc/header.inc.php';

//si on n'a pas reçu une demande de page en get
$page= !empty($_GET['page']) ? $_GET['page'] :'';

/* NOTE : obliger de faire comme ça plutot que de le 
mettre par defaut dans le switch car sinon 
le javascript ne fonctionne pas ! */
if($page==''){
?>
<div id="intro" class="divFlexRow center">

<div id="home"></div>
<div id="spanChangeSection" class="divFlexRow"><span class="rond" id="s1"></span> . <span id="s2" class="rond"></span> . 
<span class="rond" id="s3"></span></div>

</div>
<?php
include 'inc/sections/avis.inc.php';
}//fin du si $_GET est vide

//Selon la demande en get on affiche le contenu choisi
switch ($page) {
    case 'vip':
        include 'inc/sections/devenirVip.inc.php';
        break;
    case 'event':
        include 'inc/sections/event.inc.php';
        break;
    case 'team':
        include 'inc/sections/team.inc.php';
        break;
    case 'comment':
        include 'inc/sections/comment.inc.php';
        break;
    case 'gallerie':
        include 'inc/sections/gallerie.inc.php';
        break;
    case 'vote':
        include 'inc/sections/topserveurVote.inc.php';
    break;
    case 'login':
        include 'security/login.php';
        break;
    case 'page404':
            include 'inc/sections/page404.inc.php';
        break;
    case 'dis':
        //unset($_SESSION['user']);
        session_destroy();
        $_SESSION['messages']['info'][]='A bientôt !!';
        include 'security/login.php';
        break;
    default:
    $_GET['page'] ='';
}

/* le footer */
require_once 'inc/footer.inc.php';

?>
