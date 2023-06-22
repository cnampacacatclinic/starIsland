<section id="team" class="fontImage1">
    <h2>L'équipe</h2>
    <ul class="teamUl">
        <li>Tous</li>
        <li>Admin</li>
        <li>Staff/Modos</li>
        <li>Dévelloppeur</li>
        <li>Mappers</li>
        <li>Helpers</li>
    </ul>
    <div id="teamAlbum" class="divFlexRow">
    <?php
    for ($i=0;$i<=30;$i++) {
        for ($e=1;$e<=4;$e++) {
    ?>
        <figure>
            <img class="teamAvatar" src="assets/img/avatar-<?php echo $e++;?>.png">
            <figcaption class="teamReseauxSociaux">
                Role: Admin<br>
                Nom
                <ul class="teamReseauxSociaux">
                    <li><a title="resaux social" href="#"><img class="couleurSVG" alt="icone reseau social" src="assets/fontawesome-free/svgs/brands/facebook-square.svg"></a></li>
                    <li><a title="resaux social" href="#"><img class="couleurSVG" alt="icone reseau social" src="assets/fontawesome-free/svgs/brands/instagram-square.svg"></a></li>
                    <li><a title="resaux social" href="#"><img class="couleurSVG" alt="icone reseau social" src="assets/fontawesome-free/svgs/brands/twitter-square.svg"></a></li>
                    <li><a title="resaux social" href="#"><img class="couleurSVG" alt="icone reseau social" src="assets/fontawesome-free/svgs/brands/discord.svg"></a></li>
                </ul>
            </figcaption>
        </figure>
    <?php 
        $i++;
    }}
    ?>
    </div>
</section>