<?php

$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

$room = $viewModel->get("room");
$departments = $viewModel->get("departments");
$clients = $viewModel->get("clients");
?>

<form class="form-horizontal validate" action="" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="id" value="<?php echo $room['id'];?>">

    <div class="form-group">
        <label for="department_id" class="col-sm-2 control-label">Department</label>
        <div class="col-sm-10">
            <select id="department_id" class="form-control" name="department_id" required>
                <option value="">wähle ein Department aus</option>
                <?php foreach($departments as $department){
                    $selected = (isset($room['department_id']) && $department['id'] === $room['department_id']) ? 'selected' : '';
                    echo "<option  value='".$department['id']."' ".$selected." >".$department['name']."</option>";
                }?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="client_id" class="col-sm-2 control-label">Kunde</label>
        <div class="col-sm-10">
            <select id="department_id" class="form-control" name="client_id" required>
                <option  value="">wähle einen Kunden aus</option>
                <?php foreach($clients as $client){
                    $selected =  (isset($room['client_id']) && $client['id'] === $room['client_id']) ? 'selected' : '';
                    echo "<option  value='".$client['id']."' ".$selected." >".$client['name']." ".$client['lastname']."</option>";
                }?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="<?php echo $room['name'];?>" id="name" placeholder="der Raumname" required>
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" value="<?php echo $room['title'];?>" id="title" placeholder="der Raumtitle" required>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Beschreibung</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description" placeholder="die Raumbeschreibung" required><?php echo ($room['description']) ? $room['description'] : "Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.";?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="image" class="col-sm-2 control-label">Bild</label>
        <div class="col-sm-10">
            <?php
            if(!empty($room['img'])){
                echo '<img src="/images/thumbnails/thumb_'.$room['img'].'" alt="'.$room['img'].'"/>';
                echo '<input type="hidden" name="image" value="'.$room['img'].'">';
            }
            ?>
            <input type="file" name="image" value="" id="image" placeholder="das Raumbild" accept="image/*" required>
        </div>
    </div>

    <div class="form-group">
        <label for="slider" class="col-sm-2 control-label">im Slider zeigen</label>
        <div class="col-xs-1">
            <input class="form-control" type="checkbox" name="slider" value="1" id="slider" <?php echo ($room['slider']) ? "checked": "";?>>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Raum speichern</button>
        </div>
    </div>
</form>