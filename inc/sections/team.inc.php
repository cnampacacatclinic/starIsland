<?php 
//on demande la liste des roles
$roles=execute("SELECT DISTINCT role_team FROM team ORDER BY role_team")->fetchAll(PDO::FETCH_ASSOC);
//on demande les renseigenemt sur les membres de l'equipe
$data=execute("SELECT * FROM team ORDER BY nickname_team")->fetchAll(PDO::FETCH_ASSOC);

?>

<section id="team" class="fontImgTeam">
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
        $mom=$membre['nickname_team'];
        $idTeam=$membre['id_team'];

        //on demande les avatars des membres de l'equipe
        $img=execute("SELECT name_media FROM media
        INNER JOIN media_type
        ON media.id_media_type=media_type.id_media_type
        INNER JOIN team_media
        ON team_media.id_media=media.id_media
        WHERE media.id_media_type=2 AND team_media.id_team=$idTeam")->fetchAll(PDO::FETCH_ASSOC);

        foreach($img as $avatar):
    ?>
        <figure>
            
            <img alt="avatar" class="teamAvatar" src="assets/img/<?php echo $avatar['name_media'];?>">
            <figcaption class="teamReseauxSociaux">
                Role: <?php echo $membre['role_team'];?><br>
                <?php echo $membre['nickname_team'];
                //on demande les media des membres de l'equipe
                $medias=execute("SELECT title_media,name_media FROM media
                INNER JOIN team_media
                ON media.id_media=team_media.id_media
                INNER JOIN team
                ON team_media.id_team=team.id_team
                WHERE nickname_team='$mom' AND media.id_media_type=1")->fetchAll(PDO::FETCH_ASSOC);
                
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
        <?php endforeach;
        endforeach; ?>
    </div>
</section>