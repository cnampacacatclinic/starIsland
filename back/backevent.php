<?php require_once '../config/function.php';
if (!empty($_POST)) {


    if (empty($_POST['start_date']) && empty($_POST['end_date'])) {

        $error = 'Ce champs est obligatoire';

    }

    if (!isset($error)) {

        if (empty($_POST['id_event'])) {

            execute("INSERT INTO event(start_date_event,end_date_event) VALUES (:dateStart,:dateEnd)", array(
                ':dateStart' => $_POST['start_date'],
                ':dateEnd' => $_POST['end_date']
            ));

            $_SESSION['messages']['success'][] = 'Date de l\'event ajoutée';
            header('location:./backevent.php');
            exit();
        }// fin soumission en insert
        else {

            execute("UPDATE event SET start_date_event=:dateStart,end_date_event=:dateEnd WHERE id_event=:id", array(
                ':id' => $_POST['id_event'],
                ':dateStart' => $_POST['start_date'],
                ':dateEnd' => $_POST['end_date']
            ));

            $_SESSION['messages']['success'][] = 'Date de l\'event modifiée';
            header('location:./backevent.php');
            exit();

        }// fin soumission modification
    }// fin si pas d'erreur

}// fin !empty $_POST

$events = execute("SELECT * FROM event")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $event= execute("SELECT * FROM event WHERE id_event=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {

    $success = execute("DELETE FROM event WHERE id_event=:id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Date de l\'event supprimée';
        header('location:./backevent.php');
        exit;

    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location:./backevent.php');
        exit;
    }

}


require_once '../inc/backheader.inc.php';
?>

<h2>EVENT</h2>
<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
        <div class="form-group">
            <small class="text-danger">*</small>
            <label for="start date" class="form-label"><?php
            if(isset($_GET['id'])){
                echo $event['start_date_event'];
            }
            else{
                echo 'Date de debut';
            }
            ?></label>
            <!--<input min="<? //echo date('Y-m-d H:i:s');?>" name="start_date" id="start_date" type="datetime-local"
                   value="<? //echo $event['start_date_event'] ?? ''; ?>" class="form-control">-->
            <input min="<?=date('Y-m-d');?>" name="start_date" id="start_date" type="date"
                   value="<?=$event['start_date_event'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small><br>
            <small class="text-danger">*</small>
            <label for="end date" class="form-label"><?php
            if(isset($_GET['id'])){
                echo $event['end_date_event'];
            }else{
                echo 'Date de fin';}
            ?></label>
            <!--<input min="<? //echo date('Y-m-d H:i:s');?>" name="end_date" id="en_date" placeholder="Date de fin" type="datetime-local" value="<? //echo $event['end_date_event'] ?? ''; ?>" class="form-control">-->
            <input min="<?=date('Y-m-d');?>" name="end_date" id="en_date" placeholder="Date de fin" type="date" value="<?=$event['end_date_event'] ?? ''; ?>" class="form-control">
            <small class="text-danger"><?= $error ?? ''; ?></small>
        </div>
        <input type="hidden" name="id_event" value="<?= $event['id_event'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>

    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
        <tr>
            <th>Date du lancement</th>
            <th>Date de fin</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?= $event['start_date_event']; ?></td>
                <td><?= $event['end_date_event']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $event['id_event']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $event['id_event']; ?>&a=del" onclick="return confirm('Etes-vous sûr?')"
                       class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php require_once '../inc/backfooter.inc.php'; ?>