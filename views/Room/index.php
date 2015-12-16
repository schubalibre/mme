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
    if(isset($clients)){
        foreach($rooms as $room) {

            var_dump($room);
           /* echo "<tr>";
            echo "<td>".$client['name']."</td>";
            echo "<td>".$client['lastname']."</td>";
            echo "<td>".$client['email']."</td>";
            echo "<td><a href='/client/update/".$client['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
            echo "<td><a href='/client/delete/".$client['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
            echo "</tr>";*/
        }
    } ?>
</table>

<a class="btn btn-default" href="/room/new/" role="button">neuen Raum erstellen</a>

