<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

$category = $viewModel->get("category");

?>

<form class="form-horizontal validate" action="<?php echo isset($category['id']) ?  "/category/update/".$category['id'] : "/category/new/";?>" method="POST">
    <div class="modal-body">
    <input id="id" type="hidden" name="id" value="<?php echo $category['id'];?>">
    <div class="form-group">
        <label for="category-name" class="col-md-2 control-label">Kategoriename</label>
        <div class="col-md-10">
            <input id="name" type="text" class="form-control" name="name" value="<?php echo $category['name'];?>" id="category-name" placeholder="der Kategoriename" required>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        <button type="submit" class="btn btn-corporate">Kategorie speichern</button>
    </div>
</form>