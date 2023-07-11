<?php
  //On veut les trois dernières photos de la gallerie rangée par ordre decroissant d'id
  $gallerie=execute("SELECT * FROM media WHERE id_page=6 ORDER BY id_media DESC LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
?>
<section id="gallerie" class="fontImage1">
    <h2>Gallerie</h2>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div id="carousel1" class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block" 
      src="assets/album/Loading1.png" alt="First slide">
    </div>
    <?php
    foreach($gallerie as $imgGallerie){
    ?> 
    <div class="carousel-item">
      <img src="assets/album/<?= $imgGallerie['name_media']; ?>" alt="<?= $imgGallerie['title_media']; ?>">
    </div>
    <?php } ?>
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
<a class="linkButton" href="?page=gallerie">Voir plus d'image</a>
</section>