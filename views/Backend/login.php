<?php
$errors = $viewModel->get("errors");
if ($errors) {
    foreach ($errors as $error) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}
?>

<form action="/backend/login" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Email-Adresse</label>
        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email-Adresse">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Passwort</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Passwort">
    </div>
    <button type="submit" class="btn btn-corporate">Einloggen</button>
</form>