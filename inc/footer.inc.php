</main>
    <!-- Debut des balises script-->
    
   


   
<footer>
    <nav id="navFooter">
        <ul>
            <li class="liNav"><a target="_blank" title="instagram" href="https://www.instagram.com/starisland.fr/"><img alt="logo" src="assets/img/logo_instagram.png"></a></li>
            <li class="liNav"><a target="_blank" title="facebook" href="https://www.facebook.com/StarIslandfr-108004258577047"><img alt="logo" src="assets/img/logo_facebook.png"></a></li>
            <li class="liNav"><a target="_blank" title="tiktok" href="https://www.tiktok.com/@star.island?lang=fr"><img alt="logo" src="assets/img/logo_tick_tock.png"></a></li>
            <li><a target="_blank" title="discord" href="https://discord.gg/starisland" ><img id="logoDiscord" class="sizeLogo" alt="logo discord" src="assets/img/logo_discord_rose.png"></a></li>
            <li class="liNav"><a target="_blank" title="twitter" href="https://twitter.com/StarIslandfr"><img alt="logo" src="assets/img/logo_twitter.png"></a></li>
            <li class="liNav"><a target="_blank" title="twitch" href="https://www.twitch.tv/"><img alt="logo" src="assets/img/logo_twitsh.png"></a></li>
            <li class="liNav"><a target="_blank" title="youtube" href="https://www.youtube.com/channel/UCI7G6fNN-17g1_tOVMKRCpQ"><img alt="logo" src="assets/img/logo_youtube_2.png"></a></li>
        </ul>
    </nav>
    <div id="logoGTA" class="divFlexRow"><img alt="PEGI 18" src="assets/img/PEGI18.png">
    <img alt="logo GTA" src="assets/img/gtalogo.png"></div>
</footer>
  <script src="assets/jquery/jquery.min.js"></script>
 <script src="assets/bootstrap/js/bootstrap.js"></script>
 <script src="assets/js/timerJs.js"></script>
 <script>
        let page1 = document.getElementById("s1");
        let page2 = document.getElementById("s2");
        let page3 = document.getElementById("s3");
        let home = document.getElementById("home");
    if(home.innerHTML ===''){
        home.innerHTML=`<?php include "inc/sections/accueil.inc.php"; ?>`;
        page1.style.border='solid 3px #EA4C6F';
        page2.style.border='solid 3px #f1dfe3';
        page3.style.border='solid 3px #f1dfe3';
    }
        page1.addEventListener("click", function(){
            home.innerHTML=`<?php include "inc/sections/accueil.inc.php"; ?>`;
            page1.style.border='solid 3px #EA4C6F';
            page2.style.border='solid 3px #f1dfe3';
            page3.style.border='solid 3px #f1dfe3';
        });
        page2.addEventListener("click", function(){
            home.innerHTML=`<?php include "inc/sections/gallerie.inc.php"; ?>`;
            page2.style.border='solid 3px #EA4C6F';
            page1.style.border='solid 3px #f1dfe3';
            page3.style.border='solid 3px #f1dfe3';
        });
        page3.addEventListener("click", function(){
            home.innerHTML=`<?php include "inc/sections/topserveurVote.inc.php"; ?>`;
            page3.style.border='solid 3px #EA4C6F';
            page2.style.border='solid 3px #f1dfe3';
            page1.style.border='solid 3px #f1dfe3';
        });
    
</script>
</body>
</html>