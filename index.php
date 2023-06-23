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
?>
<!--div><span class="rond" id="s1"></span> . <span id="s2" class="rond"></span> . <span class="rond" id="s3"></span></div>
-->
<div id="intro" class="divFlexRow center">

<div id="home"></div>
<div id="spanChangeSection" class="divFlexRow"><span class="rond" id="s1"></span> . <span id="s2" class="rond"></span> . 
<span class="rond" id="s3"></span></div>

</div>

<?php
/* les sections */
//include 'inc/sections/accueil.inc.php';
//include 'inc/sections/gallerie.inc.php';
include 'inc/sections/devenirVip.inc.php';
include 'inc/sections/event.inc.php';
//include 'inc/sections/topserveurVote.inc.php';
include 'inc/sections/team.inc.php';
include 'inc/sections/avis.inc.php';

/* le footer */
require_once 'inc/footer.inc.php';

?>
