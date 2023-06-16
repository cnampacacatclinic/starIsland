<?php      require_once 'config/function.php';
            require_once 'inc/header.inc.php';

            if (isset($_GET['a']) && $_GET['a']=='dis'){

                unset($_SESSION['user']);
                $_SESSION['messages']['info'][]='A bientôt !!';
                header('location:./');
                exit();


            }
            ?>
<section class="fontImage1">
    <h1>BIENVENUE SUR STAR'S ISLAND</h1>
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
        <p>Peusdo
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star noChecked"></span>
            <span class="fa fa-star noChecked"></span>
        </p>
        <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
    </div>
    <div>
        <p>Peusdo
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star noChecked"></span>
            <span class="fa fa-star noChecked"></span>
        </p>
        <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
    </div>
    <div>
        <p>Peusdo
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star noChecked"></span>
            <span class="fa fa-star noChecked"></span>
        </p>
        <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
    </div>
    <div>
        <p>Peusdo
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star noChecked"></span>
            <span class="fa fa-star noChecked"></span>
        </p>
        <p>Lorem ipsum dolor sit ameur saepe, molestias fugit obcaecati, quam excepturi!</p>
    </div>
    <form class="form-group topServeur">
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
