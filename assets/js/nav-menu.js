
let logoDiscord = document.getElementById('logoDiscord');
let nav = document.getElementsByClassName('liNav');
logoDiscord.addEventListener("mouseleave", function() {
    document.getElementsByClassName('liNav').style.opacity=0.2;
});
logoDiscord.addEventListener("mouseover", function(){
    //nav.target.style.opacity=1;
    document.getElementsByClassName('liNav').style.opacity=1;
});