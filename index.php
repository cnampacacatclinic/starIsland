<?php      require_once 'config/function.php';
            require_once 'inc/header.inc.php';

            if (isset($_GET['a']) && $_GET['a']=='dis'){

                unset($_SESSION['user']);
                $_SESSION['messages']['info'][]='A bientôt !!';
                header('location:./');
                exit();


            }
            ?>

<section class="fontImage1" id="accueil">
<div class="divFlexColumn backgroundColor">
    <h1>BIENVENUE SUR STAR'S ISLAND</h1>
    <p>Notre serveur permet de jouer à GTA 5, développé par Rockstar. C'est un jeu vidéo de simulation de crime en monde ouvert. Disponible en mode freetoplay, il offre une expérience de jeu gratuite à une vaste communauté de joueurs. Les joueurs ont la possibilité d'incarner des personnages impliqués dans des activités de gang, de jouer le rôle de policiers ou de participer à des scénarios qui leur permettront une fantastique évasion.<br>
                Le jeu est distrayant grâce à sa liberté d'action et sa capacité à créer des histoires uniques grâce à son mode de jeu de rôle (RP) très populaire.<br>
                Sur notre serveur nous proposons également des événements réguliers, vous pourrez travailler dans la police ou participer à des braquages. Ici les joueurs peuvent coopérer pour réaliser des missions complexes et lucratives. Les joueurs vont plonger dans un monde virtuel riche et interactif.<br>
                <a target="_blank" title="Top serveur" href:"https://top-serveurs.net/gta/starsisland">N'hésitez pas à voter pour nous sur Top Serveur !</a>
    </p>
    <div><span class="rond"></span> . <span class="rond"></span> . <span class="rond"></span></div>

</div>
</section>
<section class="fontImage1">
    <h2>Gallerie</h2>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block" width="700px"
      src="assets/img/Wallpaper1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block" width="700px" src="assets/img/Wallpaper2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block" width="700px" src="assets/img/Wallpaper3.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>
<section id="avis" class="fontImage2">
<div>      
    <figure>
        <img class="avisAvatar" src="assets/img/avatar-1.png">
        <figcaption>
          <p>Peusdo
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star noChecked"></span>
              <span class="fa fa-star noChecked"></span>
          </p>
          <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
          <p>Le 19/06/2023</p>
        </figcaption>
    </figure>
    <figure>
        <img class="avisAvatar" src="assets/img/avatar-2.png">
        <figcaption>
          <p>Peusdo
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star noChecked"></span>
              <span class="fa fa-star noChecked"></span>
          </p>
          <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
          <p>Le 19/06/2023</p>
        </figcaption>
    </figure>
    <figure>
    <img class="avisAvatar" src="assets/img/avatar-3.png">
      <figcaption>
          <p>Peusdo
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star noChecked"></span>
              <span class="fa fa-star noChecked"></span>
          </p>
          <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
          <p>Le 19/06/2023</p>
        </figcaption>
    </figure>
    <figure>
        <img class="avisAvatar" src="assets/img/avatar-4.png">
        <figcaption>
          <p>Peusdo
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star noChecked"></span>
              <span class="fa fa-star noChecked"></span>
          </p>
          <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
          <p>Le 19/06/2023</p>
        </figcaption>
    </figure>
    </div> 
    <form id="topServeur" class="form-group">
        <fieldset class="form-group">
            <label>Votre avis nous interesse</label>
            <span><span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star noChecked"></span>
            <span class="fa fa-star noChecked"></span></span>
            <input type="texte" class="form-control" placeholder="Ecire votre commentaire"/>
            <button type="submit" class="btn btn-light">Publier</button>
        </fieldset>
    </form>
</section>
<?php     require_once 'inc/footer.inc.php';          ?>
