<div class="col-xs-12">
    <div class="page-header">
        <h1>Räume
            <small>Editieren, Hinzufügen und Löschen von Räumen</small>
            <small class="pull-right"><a id="new" class="btn btn-link" href="/room/new/">neuen Raum erstellen</a></small>
        </h1>
    </div>
    <?php
    $errors = $viewModel->get("errors");
    if ($errors) {
        foreach ($errors as $error) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
        }
    }
    $rooms = $viewModel->get("rooms");
    $clients = $viewModel->get("clients");
    $departments = $viewModel->get("departments");
    $images = $viewModel->get("images");
    ?>
    <table class="table hidden-xs">
        <thead>
        <tr>
            <th>Bild</th>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($rooms)) {
            foreach ($rooms as $room) {
                $class = $room['slider'] ? "slider-item" : "";
                echo "<tr>";
                echo "<td><img width='100' class='".$class."' src='/images/thumbnails/thumb_".$room['img']."' alt='".$room['name']."'></td>";
                //echo "<td>".$departments[$room['department_id']]['name']."</td>";
                //echo "<td>".$clients[$room['client_id']]['name']." " .$clients[$room['client_id']]['lastname']."</td>";
                echo "<td>".$room['name']."</td>";
                //echo "<td>".$room['title']."</td>";
                echo "<td>".$room['description']."</td>";
                echo "<td class='col-xs-1'><a href='/room/update/".$room['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
                echo "<td class='col-xs-1'><a class='delete' data-delete-element='diesen Raum' href='/room/delete/".$room['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
                echo "</tr>";
            }
        } ?>
        </tbody>
    </table>

    <div class="row visible-xs">
        <?php if (isset($rooms)) {
            foreach ($rooms as $room) {
                $class = $room['slider'] ? "slider-item" : "";
                echo '<div class="col-sm-6 col-md-4">';
                echo '<div class="thumbnail">';
                echo '<img class="'.$class.'" src="/images/thumbnails/thumb_'.$room['img'].'" alt="'.$room['img'].'">';
                echo '<div class="caption">';
                echo '<h3>'.$room['name'].'</h3>';
                echo '<p>'.$room['description'].'</p>';
                echo '<p class="text-right"><a href="/room/update/'.$room['id'].'" class="btn btn-corporate" role="button">Edit</a>';
                echo '<a href="/room/delete/'.$room['id'].'" class="btn btn-default delete" role="button">Delete</a></p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } ?>

    </div>

    <a id="new" class="btn btn-corporate" href="/room/new/" role="button">neuen Raum erstellen</a>
</div>
