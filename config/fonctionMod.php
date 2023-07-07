<?php 
//Initialisation de variables
$t;$c;$a;$array;$datas;$data='';

//Delete
function Delete($t,$c,$id,$p){
    if (!empty($_GET) && isset($id) && isset($_GET['a']) && $_GET['a'] == 'del') {
        /*Note de Catherine : J'ai ajouté le try catch parce que les erreurs ne s'affichent pas dans la page !!!!*/
        try{
            $success = execute("DELETE FROM $t WHERE $c=:id", array(
                ':id' => $id
            ));
    
            if ($success) {
                $_SESSION['messages']['success'][] = '<p>Suppression effectuée</p>';
                header('location:./'.$p.'');
                exit;
    
            } else {
                $_SESSION['messages']['danger'][] = '<p>Problème de traitement, veuillez réitérer</p>';
                header('location:./'.$p.'');
                exit;
            }
        }catch(Exception $e) { 
            $_SESSION['messages']['danger'][] = '<p>Exception !</p>';
            //var_dump($e);

        } catch(Error $e) {
            $_SESSION['messages']['danger'][] = '<p>Error !</p>';
            //var_dump($e);
        }
    
    }
    $me=isset($e) ? $e : '';
    return $me;
}

//select condition
function selectCondition($a,$t){
    $datas = execute("SELECT $a FROM $t")->fetchAll(PDO::FETCH_ASSOC);
    return $datas;
}

//Insert
function insertion($t,$a,$c,array $x){
    execute("INSERT INTO $t($a) VALUES ($c)", $x);
}
//update
function update($t,$c,$a,array $x){
    execute("UPDATE $t SET $c WHERE $a", $x);
}

function messageSession($p){
    $_SESSION['messages']['success'][] = 'Requete reussie';
    header('location:./'.$p.'');
    exit();
}

//error img
function errorImg($fileImg){
    $errorImg="";
    $error1=false;
    //Si on obtient un fichier
    if (isset($_FILES)){
        //on verifie le format du fichier        
        $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];
        if (!in_array($fileImg['type'],$formats )){
        //$errorImg.="Les formats d'image autorisés sont: les png, les jpg et les webp<br>";
        $error1=true;
        //On verifie la taille du fichier
        if ($fileImg['size'] > 2000000){
            //$errorImg.="La taille maximale autorisée pour le fichier, est de 2M";
            $error1=true;
        }//fin de si la taille est bonne
     }//fin de si le format est bon  
}//fin de si on obtient le fichier

if($error1==true){
    $errorImg.="Les formats d'image autorisés sont: les png, les jpg et les webp<br>";
    $errorImg.="La taille maximale autorisée pour le fichier, est de 2M";
}else{
    $errorImg=NULL;
}
return $errorImg;
}