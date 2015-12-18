<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

$department = $viewModel->get("department");
?>

<form class="form-horizontal validate" action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $department['id'];?>">
    <div class="form-group">
        <label for="department-name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="<?php echo $department['name'];?>" id="department-name" placeholder="der Departmentname" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Department speichern</button>
        </div>
    </div>
</form>