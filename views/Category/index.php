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
    $categories = $viewModel->get("categories");
    if(isset($categories)){
        foreach($categories as $category) {
            echo "<tr>";
            echo "<td>".$category['name']."</td>";
            echo "<td><a href='/category/update/".$category['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
            echo "<td><a href='/category/delete/".$category['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
            echo "</tr>";
        }
    } ?>
</table>

<a class="btn btn-default" href="/category/new/" role="button">neue Kategorie erstellen</a>