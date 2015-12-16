<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

$category = $viewModel->get("category");

?>

<form class="form-horizontal validate" action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $category['id'];?>">
    <div class="form-group">
        <label for="category-name" class="col-sm-2 control-label">Kategoriename</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="<?php echo $category['name'];?>" id="category-name" placeholder="der Kategoriename" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Kategorie speichern</button>
        </div>
    </div>
</form>