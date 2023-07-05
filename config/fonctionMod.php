<?php 
//Initialisation de variables
$t;$c;$a;$array;$datas;$data='';

//Delete
function Delete($t,$c,$p){
    if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
        /*Note de Catherine : J'ai ajouté le try catch parce que les erreurs ne s'affichent pas dans la page !!!!*/
        try{
            $success = execute("DELETE FROM $t WHERE $c=:id", array(
                ':id' => $_GET['id']
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
            $_SESSION['messages']['danger'][] = '<p>Problème de traitement</p>';
            $exception = var_dump($e);

        } catch(Error $e) {
            $_SESSION['messages']['danger'][] = '<p>Problème de traitement</p>';
            $exception = var_dump($e);
        }
    
    }
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

//error
function errorMessage($c){
    if ($c) {

        $error = '<p>Ce champs est obligatoire</p>';

    }
    return $error;
}