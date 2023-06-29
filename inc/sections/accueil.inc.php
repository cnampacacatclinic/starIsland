<?php 
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
    <p><?=$textHome['description_content'];?></p>
    <?php endforeach; ?>
</div>
</section>