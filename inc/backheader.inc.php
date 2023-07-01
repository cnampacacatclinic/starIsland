<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Star Island Admin</title>

    <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav  text-white sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=  BASE_PATH.'back/'; ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <img id="logo2" alt="logo" src="../assets/img/starisland.png" width="120em">
            </div>
            <div class="sidebar-brand-text mx-3 text-gray-800">Admin</sup></div>
        </a>
        <!-- Heading -->
        <div class="sidebar-heading">
        </div>
       <!-- <li class="nav-item">
            <a class="nav-link collapsed text-gray-800" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion pastille</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="dropdown-item" href="">Gestion Commande</a>
                </div>
            </div>
        </li>
        -->
        <li class="nav-item">
        <a class="nav-link collapsed text-gray-800" href="<?=BASE_PATH.'back/backevent.php';?>" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion des event</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed text-gray-800" href="<?=BASE_PATH.'back/backcomment.php';?>" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion des commentaires</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed text-gray-800" href="<?=BASE_PATH.'back/backteam.php';?>" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion de l'equipe</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed text-gray-800" href="<?=BASE_PATH.'back/media_type.php';?>" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion du type de média</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed text-gray-800" href="<?=BASE_PATH.'back/backmedia.php';?>" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion des médias</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed text-gray-800" href="<?=BASE_PATH.'back/backpage.php';?>" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion des pages</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed text-gray-800" href="<?=BASE_PATH.'back/backcontent.php';?>" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion du contenu des pages</span>
            </a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <!--<li class="nav-item ">
            <a class="nav-link collapsed text-gray-800" href="" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Gestion abonnés</span>
            </a>-->
<!--            <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"-->
<!--                 data-parent="#accordionSidebar">-->
<!--                <div class="bg-white py-2 collapse-inner rounded">-->
<!--                    <h6 class="collapse-header">Login Screens:</h6>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_newsletter_new')}}">Gestion Newsletter</a>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_membre')}}">Gestion Membre</a>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_avis')}}">Gestion Avis</a>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_contact')}}">Gestion Contact</a>-->
<!--                    <div class="collapse-divider"></div>-->
<!--                    <h6 class="collapse-header">autres:</h6>-->
<!--                    <a class="collapse-item active" href="{{path('admin_crud_slider_new')}}">Gestion slider</a>-->
<!--                </div>-->
<!--            </div>-->
      <!--  </li>-->
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link " href="<?=  BASE_PATH; ?>" role="button">
                            <span class="mr-2 d-none d-lg-inline text-gray-800">Voir le site</span>
                        </a>

                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->
            <div class="container col-3 ">

                <div class="alert  text-center">

                </div>


            </div>


            <div class="container-fluid">

                <?php if (isset($_SESSION['messages'])) :  ?>
                    <?php foreach ($_SESSION['messages'] as $type => $messages) : ?>
                        <?php foreach ($messages as $message) : ?>
                            <div class=" w-25 rounded  text-center ml-5  alert alert-<?= $type ?>"><h3><?= $message ?></h3></div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['messages']); ?>
                <?php endif; ?>









