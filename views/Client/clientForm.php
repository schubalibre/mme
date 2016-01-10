<?php
$errors = $viewModel->get("errors");
$validationErrors = isset($errors['validationErrors']) ? $errors['validationErrors'] :false;
unset($errors['validationErrors']);
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}
$client = $viewModel->get("client");
?>

<form class="form-horizontal validate" action="" method="POST">
    <div class="modal-body">
    <input type="hidden" name="id" value="<?php echo $client['id'];?>">
    <div class="form-group <?php echo isset($validationErrors['name']) ? "has-error" : false;?>">
        <label for="client-name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="<?php echo $client['name'];?>" id="client-name" placeholder="deine Name" >
            <span class="help-block text-danger"><?php echo isset($validationErrors['name']) ? $validationErrors['name'] : false;?></span>
        </div>
    </div>
    <div class="form-group <?php echo isset($validationErrors['lastname']) ? "has-error" : false;?>">
        <label for="client-last-name" class="col-sm-2 control-label">Nachname</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="lastname" value="<?php echo $client['lastname'];?>" id="client-last-name" placeholder="dein Nachname" >
            <span class="help-block text-danger"><?php echo isset($validationErrors['lastname']) ? $validationErrors['lastname'] : false;?></span>
        </div>
    </div>
    <div class="form-group <?php echo isset($validationErrors['email']) ? "has-error" : false;?>">
        <label for="client-email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="<?php echo $client['email'];?>" id="client-email" placeholder="deine E-Mail">
            <span class="help-block text-danger"><?php echo isset($validationErrors['email']) ? $validationErrors['email'] : false;?></span>
        </div>
    </div>
    <div class="form-group <?php echo isset($validationErrors['password']) ? "has-error" : false;?>">
        <label for="client-password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" value="" id="client-password" placeholder="dein Password" <?php echo empty($client['id']) ? "required" : false;?>>
            <span class="help-block text-danger"><?php echo isset($validationErrors['password']) ? $validationErrors['password'] : false;?></span>
        </div>
    </div>
    <div class="form-group <?php echo isset($validationErrors['confirm_password']) ? "has-error" : false;?>">
        <label for="client-confirm-password" class="col-sm-2 control-label">Password bestätigen</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="confirm_password" value="" id="client-confirm-password" placeholder="bestätige dein Password">
            <span class="help-block text-danger"><?php echo isset($validationErrors['confirm_password']) ? $validationErrors['confirm_password'] : false;?></span>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        <button type="submit" class="btn btn-corporate">Kunden speichern</button>
    </div>
</form>