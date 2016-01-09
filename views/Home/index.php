<?php
$rooms = $viewModel->get("rooms");
$activeDepartments = $viewModel->get("activeDepartments");
$activeCategories = $viewModel->get("activeCategories");
$articles = $viewModel->get("articles");
?>



<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container">
    <?php
    $errors = $viewModel->get("errors");
    if($errors){
        foreach($errors as $error){
            echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
        }
    }
    ?>

    <div id="rooms" class="page-header">
        <h1>Räume
            <small>wählen Sie Ihren Raum</small>
        </h1>
    </div>

    <?php if(!empty($activeDepartments)){?>
    <ul class="nav nav-pills category-links" data-filter-for="room-row">
        <li role="presentation" class="active"><a href="#">Alle</a></li>
        <?php foreach($activeDepartments as $department){?>
            <li role="presentation" ><a href="#<?php echo $department['id'];?>"><?php echo $department['name'];?></a></li>
        <?php }?>
    </ul>
    <?php }?>

    <div id="room-row" class="row product-items">

        <?php if(!empty($rooms)){
            foreach($rooms as $room){
                if($room['slider']) continue;
                echo "<div class='col-xs-12 col-sm-6 col-md-4 product-item ".$room['department_id']."'>";
                    echo "<a class='product-modal-link' href='/home/room/".$room['id']."'>
                    <img class='img-responsive' src='/images/thumbnails/thumb_".$room['img']."' alt='room'>
                    <h3 class='item-title'>".$room['name']."</h3>
                    </a>";
                echo "</div>";
            }
        }?>
    </div>


    <div id="articles" class="page-header">
        <h1>Artikel
            <small>wählen Sie einen Artikel</small>
        </h1>
    </div>

    <?php if(!empty($activeCategories)){?>
        <ul class="nav nav-pills category-links" data-filter-for="article-row">
            <li role="presentation" class="active"><a href="#">Alle</a></li>
            <?php foreach($activeCategories as $category){?>
                <li role="presentation" ><a href="#<?php echo $category['id'];?>"><?php echo $category['name'];?></a></li>
            <?php }?>
        </ul>
    <?php }?>

    <div id="article-row" class="row product-items">

        <?php if(!empty($articles)){
            foreach($articles as $article){
                echo "<div class='col-xs-12 col-sm-4 col-md-3 article product-item ".$article['category_id']."'>";
                echo "<a class='product-modal-link' href='/home/article/".$article['id']."'>
                    <img class='img-responsive' src='/images/thumbnails/thumb_".$article['img']."' alt='article'>
                    <h2 class='item-title'>".$article['name']."</h2>
                    </a>";
                echo "</div>";
            }
        }?>
    </div>
</div><!-- /.container -->