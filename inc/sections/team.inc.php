<?php 
//on demande la liste des roles
$roles=execute("SELECT DISTINCT role_team FROM team ORDER BY role_team")->fetchAll(PDO::FETCH_ASSOC);
//on demande les renseigenemt sur les membres de l'equipe
$data=execute("SELECT nickname_team, role_team FROM team ORDER BY nickname_team")->fetchAll(PDO::FETCH_ASSOC);

?>

<section id="team" class="fontImage1">
    <h2>L'équipe</h2>
    <ul class="teamUl">
        <li>Tout</li>
        <?php foreach($roles as $role): ?>
        <li><?php echo $role['role_team']; ?></li>
        <?php endforeach; ?>
    </ul>
    <div id="teamAlbum" class="divFlexRow">
    
    <?php //on va afficher les nom et les roles des membres
    foreach($data as $membre): 
    ?>
        <figure>
            <img alt="avatar" class="teamAvatar" src="assets/img/avatar-1.png">
            <figcaption class="teamReseauxSociaux">
                Role: <?php echo $membre['role_team'];?><br>
                <?php echo $membre['nickname_team'];
                $mom=$membre['nickname_team'];
                //on demande les media des membres de l'equipe
                $medias=execute("SELECT title_media,name_media FROM media 
                INNER JOIN team_media
                ON media.id_media=team_media.id_media
                INNER JOIN team
                ON team_media.id_team=team.id_team
                WHERE nickname_team='$mom'")->fetchAll(PDO::FETCH_ASSOC);
                
                //si il y a un reseau social
                if($medias!==NULL):?>
                <ul class="teamReseauxSociaux">
                    <?php //la boucle pour afficher la liste des reseaux sociaux
                    foreach($medias as $media): 
                    ?>
                        <li>
                            <a title="resaux social" href="<?php echo $media['name_media'];?>">
                                <img class="couleurSVG" alt="icone reseau social" src="assets/fontawesome-free/svgs/brands/<?php echo $media['title_media'];?>.svg">
                            </a>
                        </li>
                    <?php endforeach;
                    endif; ?>
                </ul>
            </figcaption>
        </figure>
        <?php endforeach; ?>
    </div>
</section>