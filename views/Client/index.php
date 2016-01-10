<div class="col-xs-12">
    <div class="page-header">
        <h1>Kunden
            <small>Editieren, Hinzufügen oder löschen von Kunden</small>
            <small class="pull-right"><a id="new" class="btn btn-link" href="/room/new/">neuen Raum erstellen</a>
            </small>
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
            <th>NAchname</th>
            <th>E-Mail</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $clients = $viewModel->get("clients");
        if (isset($clients)) {
            foreach ($clients as $client) {
                echo "<tr>";
                echo "<td>".$client['name']."</td>";
                echo "<td>".$client['lastname']."</td>";
                echo "<td>".$client['email']."</td>";
                echo "<td class='col-xs-1'><a href='/client/update/".$client['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
                echo "<td class='col-xs-1'><a class='delete' data-delete-element='diesen Kunden' href='/client/delete/".$client['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
                echo "</tr>";
            }
        } ?>
        </tbody>
    </table>

    <a id="new" class="btn btn-corporate" href="/room/new/" role="button">neuen Raum erstellen</a>
</div>
