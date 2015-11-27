<h1 class="page-header">Neues Departement hinzufügen</h1>

<form action="" method="post">
    <?php echo ($viewModel->get('dbError')) ? " <div class=\"alert alert-danger\" role=\"alert\">".$viewModel->get('dbError')."</div>" : "";?>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="departmentName" value="<?php echo $viewModel->get('departmentName');?>" placeholder="Name des Departments z.B. Wohnzimmer" required pattern=".{3,100}">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>