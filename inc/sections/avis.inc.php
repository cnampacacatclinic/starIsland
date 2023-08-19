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
?>

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
          
          <p><?= htmlspecialchars_decode($comment['nickname_comment']); ?>
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
          
          <p><?= htmlspecialchars_decode($comment['comment_text']); ?></p>
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
                  ':nickname_comment' => trim(htmlspecialchars(mb_convert_encoding(substr($_POST['nickname_comment'],0,20),'UTF-8'))),
                  //limite à 250 caracteres
                  ':comment_text' => trim(htmlspecialchars(mb_convert_encoding(substr($_POST['comment'],0,250),'UTF-8'))),
                  ':rating_comment' => trim(htmlspecialchars($ratingComment)),
                  ':id_media' => $last_id_media['id_media']
              ));
              $reussite=true;
          }// fin soumission en insert
      }//fin de si il n'y a pas d'erreur
    }// fin de si on obtient un $_POST

    if($reussite==true){
      $message ='<p class="rounded text-center alert alert-success blockSuccess">&#10084; Merci ! &#10084<br>Votre commentaire apparaitra après validation.</p>';
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
            <p id="textErrorModal" class="danger"></p>
            <input name="note" id="note" type="hidden" value="">
            <p class="danger"><?= $error ?? ''; ?></p>
            <input id="pseudoVisiteur" required type="text" name="nickname_comment" class="form-control" placeholder="Votre pseudo" value="">
            <p>* le nombre de caractères pour le pseudo est limité à 20.</p>
            <p class="danger"><?= $error ?? ''; ?></p>
            <textarea id="textComment" class="form-control" rows="4" cols="25" name="comment" placeholder="Ecrire votre commentaire" required value=""></textarea>
            <p>* le nombre de caractères pour le texte est limité à 250.</p>
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

  let textComment = document.getElementById('textComment');
  let formAvis = document.getElementById('topServeur');

  let modal1 =document.getElementById('modal1');
  //modal1.style.display = "none";

  formAvis.addEventListener('submit', function(e) {
    if(textComment.value.length>250 || pseudoVisiteur.value.length>20){

      document.getElementById('textErrorModal').innerHTML='C\'est trop long !<br>';

      //alert('<p>C\'est trop long !<br>Pseudo : '+pseudoVisiteur.value.length+' caractères<br>Texte : '+textComment.value.length+' caractères</p>');
      if(pseudoVisiteur.value.length>20){
        document.getElementById('textErrorModal').innerHTML+='Pseudo : '+pseudoVisiteur.value.length+' caractères. Il en faut 20 max.<br>';
      }
      if(textComment.value.length>20){
        document.getElementById('textErrorModal').innerHTML+='Texte : '+textComment.value.length+' caractères. Il en faut 250 max.';
      }

      e.preventDefault();
      

    }
  })



</script>