<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

var_dump($viewModel->get("client"));

?>

<form class="form-horizontal validate" action="" method="POST">
    <div class="form-group">
        <label for="client-name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="" id="client-name" placeholder="deine Name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="client-last-name" class="col-sm-2 control-label">Nachname</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="lastname" value="" id="client-last-name" placeholder="dein Nachname" required>
        </div>
    </div>
    <div class="form-group">
        <label for="client-email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="" id="client-email" placeholder="deine E-Mail" required>
        </div>
    </div>
    <div class="form-group">
        <label for="client-password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" value="" id="client-password" placeholder="dein Password" required>
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
            <button type="submit" class="btn btn-default">erstelle neuen Kunden</button>
        </div>
    </div>
</form>