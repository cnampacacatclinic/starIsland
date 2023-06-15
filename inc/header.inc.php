
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap-grid.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap.css.map" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap-reboot.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="fontInter">

<header>

<nav id="navStartIsland" class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=  BASE_PATH; ?>"><img id="logo" alt="logo" src="assets/img/logo_starisland.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon pink"></span>
        </button>
        <div id="menuStartisland" class="collapse navbar-collapse" id="navbarColor01">
        <a id="favHome" href="<?=  BASE_PATH; ?>"><img alt="Acceuil" src="assets/img/symbole_home_1.png">
                        <span class="visually-hidden"></span>
                    </a>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Gallerie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Devenir VIP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Serveur</a>
                </li>
                <?php     if (connect()):           ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ADMIN</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=  BASE_PATH.'back/userList.php'; ?>">Gestion utilisateur</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=  BASE_PATH.'back/'; ?>">Accès Back-office</a>
                    </div>
                </li>
                <?php     endif;           ?>

            </ul>
            <?php     if (connect()):           ?>
            <a href="<?=  BASE_PATH.'?a=dis'; ?>" class="btn btn-primary">Déconnexion</a>
            <?php        endif;        ?>

        </div>
    </div>
</nav>
</header>
<main class="paddingMarginZero">
    <?php     if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])):           ?>
    <?php     foreach ($_SESSION['messages'] as $type=>$messages):
      ?>
    <?php     foreach ($messages as $key=>$message):           ?>
    <div class="alert alert-<?=  $type; ?> text-center w-50 mx-auto">
        <p><?=  $message; ?></p>
    </div>

    <?php   unset($_SESSION['messages'][$type][$key]);
            endforeach;  endforeach;  endif;           ?>