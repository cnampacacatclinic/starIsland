<section id="avis" class="fontImage2">
<h2>Les avis &#10084;</h2>
<div>    
  <?php
  //On interroge la BDD pour avoir les 4 dernier avis
  $comments=execute("SELECT * FROM comment ORDER BY publish_date_comment DESC LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
  foreach($comments as $comment):
    //On demande les photos
    $imgComment=execute("SELECT name_media FROM media WHERE id_media=:idMediaComment",array(
      ':idMediaComment'=>$comment['id_media']
    ))->fetchAll(PDO::FETCH_ASSOC);
  foreach($imgComment as $avatarComment):
  ?> 
    <figure>
        <img class="avisAvatar" src="assets/img/<?= $avatarComment['name_media']; ?>">
        <figcaption>
          <p><?= $comment['nickname_comment']; ?>
              <span>
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">   
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
              </span>
          </p>
          <p><?= $comment['comment_text']; ?></p>
          <p><?= $comment['publish_date_comment']; ?></p>
        </figcaption>
    </figure>
    <?php endforeach;
    endforeach;?>
    <a class="linkButton" href="?page=comment">Voir tous les avis</a>
    </div> 
    <form id="topServeur" class="form-group">
        <fieldset class="form-group">
            <label>Votre avis nous interesse</label>
            <span>
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">   
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img alt="icone etoile" class="starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">
            </span>
            <input type="text" name="nickname_comment" class="form-control" placeholder="Votre pseudo" value="">
            <textarea class="form-control" rows="4" cols="25" name="comment" placeholder="Ecrire votre commentaire" required value=""></textarea>
            <button type="submit" class="btn btn-light">Publier</button>
        </fieldset>
    </form>
</section>