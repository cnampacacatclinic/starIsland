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

/* les sections */
include 'inc/sections/accueil.inc.php';
include 'inc/sections/gallerie.inc.php';
include 'inc/sections/devenirVip.inc.php';
include 'inc/sections/event.inc.php';
include 'inc/sections/avis.inc.php';

/* le footer */
require_once 'inc/footer.inc.php';

?>
