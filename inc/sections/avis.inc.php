<section id="avis" class="fontImage2">
<h2>Les avis &#10084;</h2>
<div>    
  <?php
  $reussite=false;
  $message ='';
  //On interroge la BDD pour avoir les 4 derniers avis
  $comments=execute("SELECT * FROM comment WHERE activated=1 ORDER BY publish_date_comment DESC LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
  foreach($comments as $comment):
    //On demande les photos
    $imgComment=execute("SELECT name_media FROM media WHERE id_media=:idMediaComment",array(
      ':idMediaComment'=>$comment['id_media']
    ))->fetchAll(PDO::FETCH_ASSOC);
  foreach($imgComment as $avatarComment):
  ?> 
    <figure>
        <img class="avisAvatar" src="assets/comment-avatar/<?= $avatarComment['name_media']; ?>">
        <figcaption>
          <p><?= $comment['nickname_comment']; ?>
              <span>
                <?php 
                for ($i=1; $i <= $comment['rating_comment']; $i++) { ?>
                  <img alt="icone etoile" class="etoile starChecked"  src="assets/fontawesome-free/svgs/solid/star.svg">   
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
    <a class="linkButton" href="?page=comment">Voir tous les avis</a>
    </div>

    <?php
    if (!empty($_POST)) {
      if (empty($_POST['nickname_comment'])&&empty($_POST['comment'])) {
  
          $error = '<p>Ce champs est obligatoire</p>';
  
      }
  
      if (!isset($error)) {
        //si on n'a pas la note on la remplace par zero
        $_POST['note']= !empty($_POST['note']) ? $_POST['note'] : 0;
        //si la note n'est pas de valeur numerique on la remplace par zero
        $ratingComment= is_numeric($_POST['note'])==true ? $_POST['note'] : 0;
          if (isset($_POST['nickname_comment'])) {
            //on genere un media random pour l'avatar
            $avatarC=random_int(7,9);
            $numAvatar=random_int(1,9);
            $avatarComment='avatar-'.$numAvatar.'.png';

            execute("INSERT INTO media(title_media,name_media,id_page,id_media_type) VALUES (:title_media,:name_media,:id_page,:id_media_type)", array(
              ':title_media' => 'avatar',
              ':name_media' => $avatarComment,
              ':id_page'=>3,
              ':id_media_type'=>2
            ));

            $last_id_media=execute("SELECT id_media FROM media WHERE id_media_type=2 AND id_page=3 ORDER BY id_media DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
            
             execute("INSERT INTO comment(rating_comment,comment_text,publish_date_comment,nickname_comment,id_media) VALUES (:rating_comment,:comment_text,CURRENT_TIMESTAMP(),:nickname_comment,:id_media)", array(
                  ':nickname_comment' => trim(htmlspecialchars($_POST['nickname_comment'])),
                  ':comment_text' => trim(htmlspecialchars($_POST['comment'])),
                  ':rating_comment' => trim(htmlspecialchars($ratingComment)),
                  ':id_media' => $last_id_media['id_media']
              ));
              $reussite=true;
          }// fin soumission en insert
      }//fin de si il n'y a pas d'erreur
    }// fin de si on obtient un $_POST

    if($reussite==true){
      $message ='<p class="w-25 rounded text-center alert alert-success">&#10084; Merci pour votre commentaire ! &#10084;</p>';
    }

    ?>
    <!-- Formulaire -->
    <form id="topServeur" class="form-group" method="post" action="#topServeur">
        <fieldset class="form-group">
            <label>Votre avis nous interesse</label>
            <?=$message ?? '';?>
            <span>
                <img id="start1" alt="note 1 icone etoile" class="etoile unchecked st"  src="assets/fontawesome-free/svgs/solid/star.svg">   
                <img id="start2" alt="note 2 icone etoile" class="etoile unchecked st "  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img id="start3" alt="note 3 icone etoile" class="etoile unchecked st"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img id="start4" alt="note 4 icone etoile" class="etoile unchecked st"  src="assets/fontawesome-free/svgs/solid/star.svg">
                <img id="start5" alt="note 5 icone etoile" class="etoile unchecked st" src="assets/fontawesome-free/svgs/solid/star.svg">
            </span>
            <input name="note" id="note" type="hidden" value="">
            <p class="danger"><?= $error ?? ''; ?></p>
            <input required type="text" name="nickname_comment" class="form-control" placeholder="Votre pseudo" value="">
            <p class="danger"><?= $error ?? ''; ?></p>
            <textarea class="form-control" rows="4" cols="25" name="comment" placeholder="Ecrire votre commentaire" required value=""></textarea>
            <button type="submit" class="btn btn-light">Publier</button>
        </fieldset>
    </form>
</section>
<script>
  const collection = document.getElementsByClassName('st');
  let note = document.getElementById('note');
  //console.log(collection.length);
 console.log(collection);
 for(let num=0;num<collection.length;num++){
  //console.log(num);
    collection[num].addEventListener('click', function() {
      for(let i=0;i<=num;i++){
        collection[i].style.width = '2em';
        collection[i].classList.remove("unchecked");
        collection[i].classList.add("starChecked");
        note.value = num+1;
      }
    });
  }
</script>