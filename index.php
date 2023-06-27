<?php     
/* les fonctions */
require_once 'config/function.php';

/* l'entête */
require_once 'inc/header.inc.php';

/* si on est connecté */
if (isset($_GET['a']) && $_GET['a']=='dis'){

  unset($_SESSION['user']);
  $_SESSION['messages']['info'][]='A bientôt !!';
  header('location:./');
  exit();
}
//si on n'a pas reçu une demande de page en get
$page= !empty($_GET['page']) ? $_GET['page'] :'';

/* NOTE : obliger de faire comme ça plutot que de le 
mettre par defaul dans le switch car sinon 
le javascript ne fonctionne pas ! */
if($page==''){
?>
<div id="intro" class="divFlexRow center">

<div id="home"></div>
<div id="spanChangeSection" class="divFlexRow"><span class="rond" id="s1"></span> . <span id="s2" class="rond"></span> . 
<span class="rond" id="s3"></span></div>

</div>
<?php
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
        include 'inc/sections/avis.inc.php';
        break;
    case 'gallerie':
        include 'inc/sections/gallerie.inc.php';
        break;
    case 'vote':
        include 'inc/sections/topserveurVote.inc.php';
    break;
    default:
    $_GET['page'] ='';
}



/* les sections */
//include 'inc/sections/accueil.inc.php';
//include 'inc/sections/gallerie.inc.php';
//include 'inc/sections/devenirVip.inc.php';
//include 'inc/sections/event.inc.php';
//include 'inc/sections/topserveurVote.inc.php';
//include 'inc/sections/team.inc.php';
include 'inc/sections/avis.inc.php';

/* le footer */
require_once 'inc/footer.inc.php';

?>
