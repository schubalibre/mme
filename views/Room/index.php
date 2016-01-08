<div class="page-header">
    <h1>Rooms <small>Subtext for header</small></h1>
</div>
<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}
?>
<table class="table">
    <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $rooms = $viewModel->get("rooms");
    $clients = $viewModel->get("clients");
    $departments = $viewModel->get("departments");
    $images = $viewModel->get("images");
    if(isset($rooms)){
        foreach($rooms as $room) {
            $class = $room['slider'] ? "slider-item" : "";
            echo "<tr>";
            echo "<td><img width='100' class='".$class."' src='/images/thumbnails/thumb_".$room['img']."' alt='".$room['name']."'></td>";
            //echo "<td>".$departments[$room['department_id']]['name']."</td>";
            //echo "<td>".$clients[$room['client_id']]['name']." " .$clients[$room['client_id']]['lastname']."</td>";
            echo "<td>".$room['name']."</td>";
            //echo "<td>".$room['title']."</td>";
            echo "<td>".$room['description']."</td>";
            echo "<td><a href='/room/update/".$room['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
            echo "<td><a class='delete' data-delete-element='diesen Raum' href='/room/delete/".$room['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
            echo "</tr>";
        }
    } ?>
    </tbody>
</table>

<a id="new" class="btn btn-corporate" href="/room/new/" role="button">neuen Raum erstellen</a>

