<div class="col-xs-12">
    <div class="page-header">
        <h1>Departments
            <small>Editieren, Hinzufügen und Löschen von Departments</small>
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
        $departments = $viewModel->get("departments");
        if (isset($departments)) {
            foreach ($departments as $department) {
                echo "<tr>";
                echo "<td>".$department['name']."</td>";
                echo "<td class='col-xs-1'><a href='/department/update/".$department['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
                echo "<td class='col-xs-1'><a class='delete' data-delete-element='dieses Department' href='/department/delete/".$department['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
                echo "</tr>";
            }
        } ?>
        </tbody>
    </table>

    <a id="new" class="btn btn-corporate" href="/department/new/" role="button">neues Department erstellen</a>
</div>