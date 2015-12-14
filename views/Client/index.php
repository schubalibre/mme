<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}
?>
<table class="table">
   <?php foreach($viewModel->get("clients") as $id => $client) {
       echo "<tr>";
       echo "<td>".$client['name']."</td>";
       echo "<td>".$client['lastname']."</td>";
       echo "<td>".$client['email']."</td>";
       echo "<td><a href='/client/update/".$id."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
       echo "<td><a href='/client/delete/".$id."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
       echo "</tr>";
   } ?>
</table>

<a class="btn btn-default" href="/client/newClient/" role="button">neuen Kunden erstellen</a>
