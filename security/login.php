
<?php //TODO remettre l'action = post
echo 'B@rbieD0ll , remettre l action = post<br>';
if(isset($_POST['m'])){
    echo $_POST['m'];
}
?>
<!-- On est obligé d'indiquer le fichier index.php si on met seulement "back", il n'y a pas de post ... -->
<form action="back/index.php" class="mt-5 w-75 mx-auto" method="post">

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input name="email_connexion" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" value="">
    </div>


    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>