<?php $rooms = $viewModel->get("rooms"); ?>

    <!-- Carousel
       ================================================== -->
<?php if (!empty($rooms)) { ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="10000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <?php $sliderNum = 1;
            foreach ($rooms as $i => $slider) {
                if (!$slider['slider']) {
                    continue;
                } ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $sliderNum++; ?>"></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="img"></div>
                <div class="container">
                    <div id="lazyline-caption" class="carousel-caption">
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="lazy-line-painter"></div>
                            </div>
                            <div class="col-xs-12">
                                <div class="content-wrapper">
                                    <h1>Willkommen bei Odds & Ends!</h1>
                                    <p>Die Inspirationsquelle für Ihr individuelles Zuhause!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($rooms as $i => $slider) {
                if (!$slider['slider']) {
                    continue;
                } ?>
                <div class="item">
                    <div class="img" style="background-image: url(/images/<?php echo $slider['img']; ?>);"></div>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1><?php echo $slider['name']; ?></h1>
                            <p><?php echo $slider['title']; ?></p>
                            <p><a class="btn btn-lg btn-default product-modal-link"
                                  href="<?php echo "/home/room/".$slider['id']; ?>" role="button">Raum ansehen</a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
<?php } ?>