<?php 
//Initialisation de variables
$t='';
$c='';
$a='';
$array='';

//Delete
function Delete($t,$c){
    if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
        /*Note de Catherine : J'ai ajouté le try catch parce que les erreurs ne s'affichent pas dans la page !!!!*/
        try{
            $success = execute("DELETE FROM $t WHERE $c", array(
                ':id' => $_GET['id']
            ));
    
            if ($success) {
                $_SESSION['messages']['success'][] = '<p>Suppression effectuée</p>';
                header('location:./backpage.php');
                exit;
    
            } else {
                $_SESSION['messages']['danger'][] = '<p>Problème de traitement, veuillez réitérer</p>';
                header('location:./backpage.php');
                exit;
            }
        }catch(Exception $e) { 
            $result=$e;
            $_SESSION['messages']['danger'][] = '<p>Problème de traitement</p>';
            global $result;
        } catch(Error $e) {
            $result=$e;
            $_SESSION['messages']['danger'][] = '<p>Problème de traitement</p<';
            global $result;
        }
    
    }
}

//select quand id
function selectC($a,$t,$c){
    if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

        $data = execute("SELECT $a FROM $t $c",array(
            ':id' => $_GET['id']
        ))->fetch(PDO::FETCH_ASSOC);
    }
}

//select
function selectA($a,$t){
    $datas = execute("SELECT $a FROM $t")->fetchAll(PDO::FETCH_ASSOC);
}

//Insert
function insertion($t,$a,$c,$array){
    execute("INSERT INTO $t($a) VALUES ($c)", $array);
}
//update
function update($t,$c,$a,$array){
    execute("UPDATE $t SET $c WHERE $a", $array);
}

function messageSession(){
    $_SESSION['messages']['success'][] = 'Requete reussie';
    header('location:./backcontent.php');
    exit();
}

//error
function errorMessage($c){
    if ($c) {

        $error = '<p>Ce champs est obligatoire</p>';

    }
    return $error;
}