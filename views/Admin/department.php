<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
    <div class="list-group">
        <a href="#" class="list-group-item active">Dashboard</a>
        <a href="http://mme.local/admin/department/new/" class="list-group-item">+ Neues Department hinzufügen</a>
        <a href="admin/room/new/" class="list-group-item">+ Neues Zimmer hinzufügen</a>
        <a href="admin/article/new/" class="list-group-item">+ Neuen Artikel hinzufügen</a>
    </div>
</div><!--/.sidebar-offcanvas-->

<div class="col-xs-12 col-sm-9">
    <div class="row">
        <h1 class="page-header">Department</h1>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($viewModel->get('departments') as $id => $department){?>
                    <tr>
                        <td><?php echo $department['id'];?></td>
                        <td><?php echo ucfirst($department['name']);?></td>
                        <td>
                            <a href="http://mme.local/admin/department/update/<?php echo $department['id'];?>/" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                        </td>
                        <td>
                            <a href="http://mme.local/admin/department/delete/<?php echo $department['id'];?>/" title="delete"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                <?php }?>

                </tbody>
            </table>
           <?php echo ($viewModel->get('dbError')) ? " <div class=\"alert alert-danger\" role=\"alert\">".$viewModel->get('dbError')."</div>" : "";?>
        </div>

    </div><!--/row-->
</div><!--/.col-xs-12.col-sm-9-->