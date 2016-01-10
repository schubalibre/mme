<div class="col-xs-12">
    <div class="page-header">
        <h1>Login</h1>
    </div>
    <?php
    $errors = $viewModel->get("errors");
    $validationErrors = isset($errors['validationErrors']) ? $errors['validationErrors'] :false;
    unset($errors['validationErrors']);
    if ($errors) {
        foreach ($errors as $error) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
        }
    }
    ?>

    <form action="/backend/login" method="post">
        <div class="form-group <?php echo isset($validationErrors['email']) ? "has-error" : false;?>">
            <label for="exampleInputEmail1" class="control-label">Email-Adresse</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email-Adresse">
            <span class="help-block text-danger"><?php echo isset($validationErrors['email']) ? $validationErrors['email'] : false;?></span>
        </div>
        <div class="form-group <?php echo isset($validationErrors['password']) ? "has-error" : false;?>">
            <label for="exampleInputPassword1" class="control-label">Passwort</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Passwort">
            <span class="help-block text-danger"><?php echo isset($validationErrors['password']) ? $validationErrors['password'] : false;?></span>
        </div>
        <button type="submit" class="btn btn-corporate">Einloggen</button>
    </form>
</div>