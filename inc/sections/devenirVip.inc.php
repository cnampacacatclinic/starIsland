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

//on affiche dans la page le texte
$contentVIP=execute("SELECT title_content,description_content,content.id_page,name_media FROM content
INNER JOIN page
ON page.id_page=content.id_page
INNER JOIN media
ON media.id_page=page.id_page
WHERE url='vip' GROUP BY name_media")->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="devenirVIP" class="fontImgVIP">
    <h2>Devenir V.I.P.</h2>
    <?php
    //on va afficher le texte et obtenir l'id de la page pour le media
    foreach($contentVIP as $textVip):
    ?>
        <article class="divFlexRow">
        <figure><img alt="portrait d'un membre VIP" src="assets/img/<?= $textVip['name_media'];?>"></figure>
        <div>
            <h3><?=htmlspecialchars_decode($textVip['title_content']);?></h3>
            <p><?=htmlspecialchars_decode($textVip['description_content']);?></p>
        </div>
    </article>
    <?php endforeach;?>
</section>