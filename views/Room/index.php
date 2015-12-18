<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}
?>
<table class="table">
    <?php
    $rooms = $viewModel->get("rooms");
    $clients = $viewModel->get("clients");
    $departments = $viewModel->get("departments");
    if(isset($rooms)){
        foreach($rooms as $room) {
            echo "<tr>";
            echo "<td>".$departments[$room['department_id']]['name']."</td>";
            echo "<td>".$clients[$room['client_id']]['name']." " .$clients[$room['client_id']]['lastname']."</td>";
            echo "<td>".$room['name']."</td>";
            echo "<td>".$room['title']."</td>";
            echo "<td>".$room['description']."</td>";
            echo "<td>".$room['image']."</td>";
            echo "<td><a href='/room/update/".$room['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
            echo "<td><a href='/room/delete/".$room['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
            echo "</tr>";
        }
    } ?>
</table>

<a class="btn btn-default" href="/room/new/" role="button">neuen Raum erstellen</a>

