<?php require_once "header.php"; ?>

    <div class="container ">
        <div class="row form-wrapper">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item">Artikel</a>
                    <a href="#" class="list-group-item">Räume</a>
                    <a href="#" class="list-group-item">Kategorien</a>
                    <a href="#" class="list-group-item">Ressort</a>
                    <a href="#" class="list-group-item active">Kunde</a>
                </div>
            </div>
            <div class="col-md-9">
                <form class="form-validation">
                    <div class="form-group">
                        <label for="clientName">Name*</label>
                        <input type="text" class="form-control" name="clientName" id="clientName" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="clientLastName">Nachname*</label>
                        <input type="text" class="form-control" name="clientLastName" id="clientLastName" placeholder="Nachname" required>
                    </div>
                    <div class="form-group">
                        <label for="clientEmail">E-Mail*</label>
                        <input type="email" class="form-control" name="clientEmail" id="clientEmail" placeholder="E-Mail" required>
                    </div>
                    <div class="form-group">
                        <label for="clientPassword">Passwort*</label>
                        <input type="password" class="form-control" name="clientPassword" id="clientPassword" placeholder="Passwort" required>
                    </div>
                    <div class="form-group">
                        <label for="clientRePassword">Passwort wiederholen</label>
                        <input type="password" class="form-control" name="clientRePassword" id="clientRePassword" placeholder="Passwort wiederholen" required>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php require_once "footer.php"; ?>