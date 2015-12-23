<?php
$rooms = $viewModel->get("rooms");
$activeDepartments = $viewModel->get("activeDepartments");
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
            <small>wählen sie Ihren Raum</small>
        </h1>
    </div>

    <?php if(!empty($activeDepartments)){?>
    <ul class="nav nav-pills category-links" data-filter-for="article-row">
        <li role="presentation" class="active"><a href="#">Alle</a></li>
        <?php foreach($activeDepartments as $department){?>
            <li role="presentation" ><a href="#<?php echo $department['id'];?>"><?php echo $department['name'];?></a></li>
        <?php }?>
    </ul>
    <?php }?>

    <div id="article-row" class="row">

        <?php if(!empty($rooms)){
            foreach($rooms as $room){
                echo "<div class='col-xs-6 col-md-4 room-item ".$room['department_id']."'>";
                    echo "<a href='/room/ajax/".$room['id']."'>
                    <img class='img-responsive' src='/images/thumbnails/".$room['thumbnail']."' alt='article'>
                    <h1 class='roomTitle'>".$room['name']."</h1>
                    </a>";
                echo "</div>";
            }
        }?>
    </div>
    <div class="pull-right">
        <button id="loadArticle" type="button" class="btn btn-primary btn-sm">show more</button>
    </div>


    <div id="articles" class="page-header">
        <h1>Artikel
            <small>wählen Sie einen Artikel</small>
        </h1>
    </div>

    <ul class="nav nav-pills category-links">
        <li role="presentation" class="active"><a href="#">Stühle</a></li>
        <li role="presentation"><a href="#">Tische</a></li>
        <li role="presentation"><a href="#">Schränke</a></li>
        <li role="presentation"><a href="#">Betten</a></li>
        <li role="presentation"><a href="#">Accessoires</a></li>
    </ul>

    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <a href=""><img class="img-responsive" src="holder.js/265x210" alt="article"></a>
            </div>
        </div>

    </div>
</div><!-- /.container -->