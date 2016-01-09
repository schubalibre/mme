<div class="col-xs-12">
    <div class="page-header">
        <h1>Artikel
            <small>Editieren, Hinzufügen und Löschen von Artikeln</small>
        </h1>
    </div>

    <?php
    /**
     * Created by PhpStorm.
     * User: roberto
     * Date: 18.12.15
     * Time: 13:46
     */

    $errors = $viewModel->get("errors");
    if ($errors) {
        foreach ($errors as $error) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
        }
    }
    $articles = $viewModel->get("articles");
    $rooms = $viewModel->get("rooms");
    $categories = $viewModel->get("categories");
    ?>
    <table class="table hidden-xs">
        <thead>
        <tr>
            <th>Bild</th>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($articles)) {
            foreach ($articles as $article) {
                echo "<tr>";
                echo "<td><img width='100' src='/images/thumbnails/thumb_".$article['img']."' alt='".$article['img']."'></td>";
                //echo "<td>".$rooms[$article['room_id']]['name']."</td>";
                //echo "<td>".$categories[$article['category_id']]['name']."</td>";
                echo "<td>".$article['name']."</td>";
                //echo "<td>".$article['title']."</td>";
                echo "<td>".$article['description']."</td>";
                //echo "<td>".$article['shop']."</td>";
                //echo "<td>".$article['website']."</td>";
                echo "<td class='col-xs-1'><a href='/article/update/".$article['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
                echo "<td class='col-xs-1'><a class='delete' data-delete-element='diesen Artikel' href='/article/delete/".$article['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
                echo "</tr>";
            }
        } ?>
        </tbody>
    </table>

    <div class="row visible-xs">
        <?php if (isset($articles)) {
            foreach ($articles as $article) {
                echo '<div class="col-sm-6 col-md-4">';
                echo '<div class="thumbnail">';
                echo '<img src="/images/thumbnails/thumb_'.$article['img'].'" alt="'.$article['img'].'">';
                echo '<div class="caption">';
                echo '<h3>'.$article['name'].'</h3>';
                echo '<p>'.$article['description'].'</p>';
                echo '<p class="text-right"><a href="/article/update/'.$article['id'].'" class="btn btn-corporate" role="button">Edit</a>';
                echo '<a href="/article/delete/'.$article['id'].'" class="btn btn-default delete" role="button">Delete</a></p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } ?>

    </div>

    <a id="new" class="btn btn-corporate" href="/article/new/" role="button">neuen Artikel erstellen</a>
</div>