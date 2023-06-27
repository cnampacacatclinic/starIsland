<?php     

require_once '../config/function.php';

require_once '../inc/backheader.inc.php';?>

<form action="" method="POST">
  <div class="form-group">
    <label for="text">text</label>
    <input class="form-control w-75 p-3" type="text" placeholder="Readonly input here…" readonly>
    </div>
  <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>

<?php require_once '../inc/backfooter.inc.php';?>