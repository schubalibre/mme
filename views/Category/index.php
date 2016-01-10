<div class="col-xs-12">
    <div class="page-header">
        <h1>Kategorie
            <small>Editieren, Hinzufügen oder löschen von Kategorien</small>
            <small class="pull-right"><a id="new" class="btn btn-link" href="/category/new/">neue Kategorie erstellen</a></small>
        </h1>
    </div>

    <?php
    $errors = $viewModel->get("errors");
    if ($errors) {
        foreach ($errors as $error) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
        }
    }
    ?>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $categories = $viewModel->get("categories");
        if (isset($categories)) {
            foreach ($categories as $category) {
                echo "<tr>";
                echo "<td>".$category['name']."</td>";
                echo "<td  class='col-xs-1'><a href='/category/update/".$category['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
                echo "<td  class='col-xs-1'><a class='delete' data-delete-element='diese Kategorie' href='/category/delete/".$category['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
                echo "</tr>";
            }
        } ?>
        </tbody>
    </table>

    <a id="new" class="btn btn-corporate" href="/category/new/" role="button">neue Kategorie hinzufügen</a>
</div>