<section id="avis" class="fontImage2">
<h2>Tous les avis &#10084;</h2>
<div>    
  <?php
  //On interroge la BDD pour avoir les avis rangé par ordre de date
  $comments=execute("SELECT * FROM comment WHERE activated=1 ORDER BY publish_date_comment DESC")->fetchAll(PDO::FETCH_ASSOC);
  foreach($comments as $comment):
    //$idComment=$comment['id_comment'];
    //On demande les photos
    $imgComment=execute("SELECT name_media FROM media WHERE id_media=:idMediaComment",array(
      ':idMediaComment'=>$comment['id_media']
    ))->fetchAll(PDO::FETCH_ASSOC);
    foreach($imgComment as $avatarComment):
  ?> 
    <figure>
        <img class="avisAvatar" src="assets/avatar/<?= $avatarComment['name_media']; ?>">
        <figcaption>
          <p><?= $comment['nickname_comment']; ?>
              <span>
              <?php 
                for ($i=1; $i <= $comment['rating_comment']; $i++) { ?>
                  <img alt="icone etoile" class="starChecked etoile"  src="assets/fontawesome-free/svgs/solid/star.svg">   
                <?php
                $i;
                }
              ?>
              </span>
          </p>
          <p><?= $comment['comment_text']; ?></p>
          <p><?= $comment['publish_date_comment']; ?></p>
        </figcaption>
    </figure>
    <?php endforeach;
    endforeach;?>
    </div>
</section>