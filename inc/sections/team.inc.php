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
    <div class="divFlexRow">
    <?php 
    for ($i=0;$i<=40;$i++) {
    ?>
        <figure class="over">
            <img class="teamAvatar" src="assets/img/avatar-3.png">
            <figcaption class="overlay">
                Role<br>
                Nom
                <ul class="teamReseauxSociaux">
                    <li><a title="resaux social" href="#">icone</a></li>
                    <li><a title="resaux social" href="#">icone</a></li>
                    <li><a title="resaux social" href="#">icone</a></li>
                    <li><a title="resaux social" href="#">icone</a></li>
                </ul>
            </figcaption>
        </figure>
    <?php 
        $i++;
    }
    ?>
    </div>
</section>