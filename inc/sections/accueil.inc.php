<?php /*/////////////////////////////////
* Catherine Jules
* Date : Juin / Juillet 2023
* TP pour SIMPLON
* CDA
* NB: Le TP est en PHP procédural 
car c'était demandé pour cet
exercice.
/////////////////////////////////*/

//on affiche dans la page le texte
$contentHome=execute("SELECT title_content,description_content,content.id_page FROM content 
INNER JOIN page
ON page.id_page=content.id_page
WHERE url='home'")->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="fontImage1" id="accueil">
<div class="divFlexColumn backgroundColor">
    <?php foreach($contentHome as $textHome):
    ?>
    <h1><?=$textHome['title_content'];?></h1>
    <p><?=mb_convert_encoding($textHome['description_content'],'UTF-8');?></p>
    <?php endforeach; ?>
</div>
</section>