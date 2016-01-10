<?php
$errors = $viewModel->get("errors");
$validationErrors = isset($errors['validationErrors']) ? $errors['validationErrors'] :false;
unset($errors['validationErrors']);
if ($errors) {
    foreach ($errors as $msg => $error) {
        if(isset($error['validationErrors']) && is_array($error['validationErrors'])) {
            foreach($error['validationErrors'] as $field => $errormsg){
                echo "<div class=\"alert alert-danger\" role=\"alert\">Fehler im Feld $field:  $errormsg</div>";
            }
        }else{
            echo "<div class=\"alert alert-danger\" role=\"alert\">$msg</div>";
        }
    }
}

$department = $viewModel->get("department");
?>

<form class="form-horizontal validate" action="<?php echo isset($department['id']) ?  "/department/update/".$department['id'] : "/department/new/";?>" method="POST">
    <div class="modal-body">
        <input id="id" type="hidden" name="id" value="<?php echo $department['id']; ?>">

        <div class="form-group <?php echo isset($validationErrors['name']) ? "has-error" : false;?>">
            <label for="department-name" class="col-sm-2 control-label">Name</label>

            <div class="col-sm-10">
                <input id="name" type="text" class="form-control" name="name" value="<?php echo $department['name']; ?>"
                       id="department-name" placeholder="der Departmentname" >
                <span class="help-block text-danger"><?php echo isset($validationErrors['name']) ? $validationErrors['name'] : false;?></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        <button type="submit" class="btn btn-corporate">Department speichern</button>
    </div>
</form>