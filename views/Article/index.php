<div class="page-header">
    <h1>Articles <small>Subtext for header</small></h1>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 18.12.15
 * Time: 13:46
 */

$errors = $viewModel->get("errors");
if($errors){
    foreach($errors as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}
?>
<table class="table">
    <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $articles = $viewModel->get("articles");
    $rooms = $viewModel->get("rooms");
    $categories = $viewModel->get("categories");
    if(isset($articles)){
        foreach($articles as $article) {
            echo "<tr>";
            echo "<td><img width='100' src='/images/thumbnails/thumb_".$article['img']."' alt='".$article['img']."'></td>";
            //echo "<td>".$rooms[$article['room_id']]['name']."</td>";
            //echo "<td>".$categories[$article['category_id']]['name']."</td>";
            echo "<td>".$article['name']."</td>";
            //echo "<td>".$article['title']."</td>";
            echo "<td>".$article['description']."</td>";
            //echo "<td>".$article['shop']."</td>";
            //echo "<td>".$article['website']."</td>";
            echo "<td><a href='/article/update/".$article['id']."/'/><san class='glyphicon glyphicon-edit' aria-hidden=\"true\"></san></a></td>";
            echo "<td><a class='delete' data-delete-element='diesen Artikel' href='/article/delete/".$article['id']."/'/><span class='glyphicon glyphicon-remove' aria-hidden=\"true\"></span></a></td>";
            echo "</tr>";
        }
    } ?>
    </tbody>
</table>

<a id="new" class="btn btn-corporate" href="/article/new/" role="button">neuen Artikel erstellen</a>