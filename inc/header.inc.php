
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
 require_once 'config/function.php'; 
?>

<!doctype html>
<html lang="fr">
<head>
    <!-- Catherine Jules -->
    <!--    Juin 2023    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    On change le titre et la description en fonction de la page    -->
    <?php $namePageDescription=isset($_GET['page'])? 'Page : '.$_GET['page'] :''; ?>
    <title>Star's Island <?php echo $namePageDescription; ?></title>
	<meta name="description" content="<?php echo $namePageDescription; ?> du site du serveur Star's Island">
    
    <!-- Debut des balises meta Facebook-->
    <meta property="og:site_name" content="Star's Island serveur GTA 5">
    <meta property="og:title" content="Star's Island">
    <meta property="og:description" content="Page du site du serveur Star's Island">
    <meta property="og:url" content="https://starisland.fr">
    <meta property="og:image" content="assets/img/logo_starisland.png">
    <meta property="og:image:alt" content="logo du site du serveur Star's Island">
    <meta property="og:type" content="website">
 
    <!-- Debut des balises meta Twitter-->
    <meta name="twitter:title" content="Star's Island serveur GTA 5">
    <meta name="twitter:description" content="Page du site du serveur Star's Island">
    <meta name="twitter:image" content="assets/img/logo_starisland.png">
    <meta name="twitter:domain" content="https://starisland.fr">

    <!-- Debut des balises link pour le CSS -->
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap-grid.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap.css.map" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap-reboot.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body class="fontInter">

<header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?=  BASE_PATH; ?>"><img id="logo" alt="logo" src="assets/img/logo_starisland.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon pink"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	<a id="favHome" href="<?=  BASE_PATH; ?>"><img alt="Acceuil" src="assets/img/symbole_home_1.png"></a>
    <ul class="navbar-nav">
      <li class="nav-item">
                    <a class="nav-link" href="?page=gallerie">Gallerie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=vip">Devenir VIP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=team">Equipe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Serveur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://docs.google.com/spreadsheets/d/1ca-sSQERai88NWyIMIXPckhgQ3li5AeXv7zzT1ux_I4/edit#gid=582164751">Réglement</a>
                </li>
                <li class="nav-item liSmall">
                    <a class="nav-link" href="?page=event">Event</a>
                </li>
                <li class="nav-item liSmall">
                    <a class="nav-link" href="#">Tuto</a>
                </li>
            <div id="divEventTuto">
                <ul id="buttonsNav">
                        <li class="nav-item liBig">
                            <a class="nav-link" href="?page=event"><img class="buttonNav" alt="lien tuto" src="assets/img/bouton-event.png"></a>
                        </li>
                        <li class="nav-item liBig">
                            <a class="nav-link" href="#"><img class="buttonNav" alt="lien event" src="assets/img/bouton_tuto.png"></a>
                        </li>
                </ul>
            </div>
    </div>
</nav>
</header>
<main class="paddingMarginZero">