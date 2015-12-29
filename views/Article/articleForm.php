<?php
$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

$article = $viewModel->get("article");
$rooms = $viewModel->get("rooms");
$categories = $viewModel->get("categories");
?>

<form class="form-horizontal validate" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $article['id'];?>">
    <div class="form-group">
        <label for="category_id" class="col-sm-2 control-label">Kategorie</label>
        <div class="col-sm-10">
            <select id="category_id" class="form-control" name="category_id" required>
                <option value="">wähle eine Kategorie aus</option>
                <?php foreach($categories as $category){
                    $selected = (isset($article['category_id']) && $category['id'] === $article['category_id']) ? 'selected' : '';
                    echo "<option  value='".$category['id']."' ".$selected." >".$category['name']."</option>";
                }?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="room_id" class="col-sm-2 control-label">Raum</label>
        <div class="col-sm-10">
            <select id="room_id" class="form-control" name="room_id" required>
                <option value="">wähle einen Raum aus</option>
                <?php foreach($rooms as $room){
                    $selected = (isset($article['category_id']) && $room['id'] === $article['category_id']) ? 'selected' : '';
                    echo "<option  value='".$room['id']."' ".$selected." >".$room['name']."</option>";
                }?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Artikelname</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="<?php echo $article['name'];?>" id="aname" placeholder="der Artikelname" required>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Artikeltitel</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" value="<?php echo $article['title'];?>" id="atitle" placeholder="der Artikeltitle" required>
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Artikelbeschreibung</label>
        <div class="col-sm-10">
            <textarea id="description" class="form-control" name="description" placeholder="die Artikelbeschriftung" required><?php echo $article['description'] ? $article['description'] : "Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.";?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="article-img" class="col-sm-2 control-label">Artikelbilder</label>
        <div class="col-sm-10">
            <input type="file" name="image" id="article-img" placeholder="die Artikelbilder" accept="image/*" required>
        </div>
    </div>

    <div class="form-group">
        <label for="shop" class="col-sm-2 control-label">Artikelshop</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="shop" value="<?php echo $article['shop'] ? $article['shop'] : "IKEA";?>" id="shop" placeholder="der Artikelshop" required>
        </div>
    </div>

    <div class="form-group">
        <label for="website" class="col-sm-2 control-label">Artikel Website</label>
        <div class="col-sm-10">
            <input type="url" class="form-control" name="website" value="<?php echo $article['website'] ? $article['website'] : "http://www.ikea.de";?>" id="website" placeholder="die Artikelwebpage" required>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Artikel speichern</button>
        </div>
    </div>
</form>