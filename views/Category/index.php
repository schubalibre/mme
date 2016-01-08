<div class="page-header">
    <h1>Categories <small>Subtext for header</small></h1>
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
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $categories = $viewModel->get("categories");
    if(isset($categories)){
        foreach($categories as $category) {
            echo "<tr>";
            echo "<td>".$category['name']."</td>";
            echo "<td><a href='/category/update/".$category['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
            echo "<td><a class='delete' data-delete-element='diese Kategorie' href='/category/delete/".$category['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
            echo "</tr>";
        }
    } ?>
    </tbody>
</table>

<a id="new" class="btn btn-corporate" href="/category/new/" role="button">neue Kategorie erstellen</a>