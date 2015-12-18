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
    $departments = $viewModel->get("departments");
    if(isset($departments)){
        foreach($departments as $department) {
            echo "<tr>";
            echo "<td>".$department['name']."</td>";
            echo "<td><a href='/department/update/".$department['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
            echo "<td><a class='delete' data-delete-element='dieses Department' href='/department/delete/".$department['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
            echo "</tr>";
        }
    } ?>
</table>

<a class="btn btn-default" href="/department/new/" role="button">neues Department erstellen</a>
