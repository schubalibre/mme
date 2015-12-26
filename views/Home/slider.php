<?php $rooms = $viewModel->get("rooms"); ?>

<!-- Carousel
   ================================================== -->
<?php if(!empty($rooms)) { ?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php $class="active"; foreach($rooms as $i => $slider){
            if(!$slider['slider']) continue; ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo $class;?>"></li>
        <?php $class=""; }?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php  $class="active"; foreach($rooms as $i => $slider){
            if(!$slider['slider']) continue; ?>
        <div class="item <?php echo $class;?>">
            <div class="img" style="background-image: url(/images/<?php echo $slider['img'];?>);"></div>
            <div class="container">
                <div class="carousel-caption">
                    <h1><?php echo $slider['name'];?></h1>
                    <p><?php echo $slider['title'];?></p>
                    <p><a class="btn btn-lg btn-corporate" href="#" role="button">Raum ansehen</a></p>
                </div>
            </div>
        </div>
        <?php $class=""; }?>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->
<?php }?>