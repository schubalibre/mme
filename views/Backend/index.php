<div class="col-xs-12">
    <?php
    $errors = $viewModel->get("errors");
    if ($errors) {
        foreach ($errors as $error) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
        }
    }
    ?>

    <h1 class="page-header">Herzlich Willkommen bei Odds & Ends</h1>
    <p>Wählen Sie eine Kategorie um neue Elemente hinzuzufügen, zu editieren oder zu löschen.</p>

    <div class="list-group">
        <a href="/article" class="list-group-item">Artikel</a>
        <a href="/room" class="list-group-item">Räume</a>
        <a href="/category" class="list-group-item">Kategorien</a>
        <a href="/department" class="list-group-item">Department</a>
    </div>
</div>