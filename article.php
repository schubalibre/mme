<?php require_once "header.php"; ?>

    <div class="container ">
        <div class="row form-wrapper">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item active">Artikel</a>
                    <a href="#" class="list-group-item">Räume</a>
                    <a href="#" class="list-group-item">Kategorien</a>
                    <a href="#" class="list-group-item">Ressort</a>
                    <a href="#" class="list-group-item">Kunde</a>
                </div>
            </div>
            <div class="col-md-9">
                <form>
                    <div class="form-group">
                        <label for="room">Raum</label>
                        <select id="room" class="form-control" name="room" required>
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="room">Kategorie</label>
                        <select id="room" class="form-control" name="room" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="articleName">Artikelname</label>
                        <input type="text" class="form-control" id="articleName" placeholder="Artikelname">
                    </div>
                    <div class="form-group">
                        <label for="articleTitle">Artikeltitel</label>
                        <input type="text" class="form-control" id="articleTitle" placeholder="Artikeltitel">
                    </div>

                    <div class="form-group">
                        <label for="articleDescription">Artikelbeschreibung</label>
                        <textarea id="articleDescription" class="form-control" rows="3" name="articleDescription"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="articleImage">Article Image</label>
                        <input type="file" id="articleImage">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="articleTitle">Artikel Breite</label>
                            <input type="text" class="form-control" id="articleTitle" placeholder="Artikeltitel">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="articleTitle">Artikel Höhe</label>
                            <input type="text" class="form-control" id="articleTitle" placeholder="Artikeltitel">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="articleTitle">Artikel Tiefe</label>
                            <input type="text" class="form-control" id="articleTitle" placeholder="Artikeltitel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="shop_name">Shopname</label>
                        <input type="email" class="form-control" name="shop_name" id="shop_name" placeholder="Shopname">
                    </div>
                    <div class="form-group">
                        <label for="webpage">Webpage</label>
                        <input type="url" class="form-control" name="webpage" id="webpage" placeholder="Webpage">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>

<?php require_once "footer.php"; ?>