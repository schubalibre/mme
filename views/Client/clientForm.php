<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

$client = $viewModel->get("client");

?>

<form class="form-horizontal validate" action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $client['id'];?>">
    <div class="form-group">
        <label for="client-name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="<?php echo $client['name'];?>" id="client-name" placeholder="deine Name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="client-last-name" class="col-sm-2 control-label">Nachname</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="lastname" value="<?php echo $client['lastname'];?>" id="client-last-name" placeholder="dein Nachname" required>
        </div>
    </div>
    <div class="form-group">
        <label for="client-email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="<?php echo $client['email'];?>" id="client-email" placeholder="deine E-Mail" required>
        </div>
    </div>
    <div class="form-group">
        <label for="client-password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" value="" id="client-password" placeholder="dein Password" <?php echo empty($client['id']) ? "required" : false;?>>
        </div>
    </div>
    <div class="form-group">
        <label for="client-confirm-password" class="col-sm-2 control-label">Password bestätigen</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="confirm_password" value="" id="client-confirm-password" placeholder="bestätige dein Password">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Kunden speichern</button>
        </div>
    </div>
</form>