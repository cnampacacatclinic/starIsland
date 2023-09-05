
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

if(isset($_SESSION['messages'])){
    $_SESSION['messages'];
}
?>
<section id="avis" class="fontImage2">
    <h2>Connexion</h2>
    B@rbieD0ll
<!-- On est obligé d'indiquer le fichier index.php si on met seulement "back", il n'y a pas de post ... -->
<form id="login" action="back/index.php" class="mt-5 w-75 mx-auto" method="post">
    <fieldset>
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input name="email_connexion" type="text" class="form-control" id="exampleInputEmail1" value="">

        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" value="">
    <button type="submit" class="btn btn-primary">Submit</button>
    </fieldset>
</form>
</section>