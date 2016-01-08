<div id="articleFormModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <form class="form-horizontal validate" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="category_id" class="col-sm-2 control-label">Kategorie</label>
                        <div class="col-sm-10">
                            <select id="category_id" class="form-control" name="category_id" required>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="room_id" class="col-sm-2 control-label">Raum</label>
                        <div class="col-sm-10">
                            <select id="room_id" class="form-control" name="room_id" required>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Artikelname</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="" id="name" placeholder="der Artikelname" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Artikeltitel</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="" id="atitle" placeholder="der Artikeltitle" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Artikelbeschreibung</label>
                        <div class="col-sm-10">
                            <textarea id="description" class="form-control" name="description" placeholder="die Artikelbeschriftung" required>Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen.</textarea>
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
                            <input type="text" class="form-control" name="shop" value="IKEA" id="shop" placeholder="der Artikelshop" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website" class="col-sm-2 control-label">Artikel Website</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" name="website" value="http://www.ikea.de" id="website" placeholder="die Artikelwebpage" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-corporate">Artikel speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>