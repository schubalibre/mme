<?php require_once "header.php"; ?>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img class="img-responsive" class="first-slide"
                     src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                     alt="First slide">

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Example headline.</h1>

                        <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous"
                            Glyphicon buttons on the left and right might not load/display properly due to web browser
                            security rules.</p>

                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" class="second-slide"
                     src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                     alt="Second slide">

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>

                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                            gravida
                            at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" class="third-slide"
                     src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                     alt="Third slide">

                <div class="container">
                    <div class="carousel-caption">
                        <h1>One more for good measure.</h1>

                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                            gravida
                            at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                    </div>
                </div>
            </div>
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


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <div class="page-header">
            <h1>Räume
                <small>wählen sie ihren Raum</small>
            </h1>
        </div>

        <ul class="nav nav-pills category-links">
            <li role="presentation" class="active"><a href="#">Küche</a></li>
            <li role="presentation"><a href="#">Wohnzimmer</a></li>
            <li role="presentation"><a href="#">Schlafzimmer</a></li>
            <li role="presentation"><a href="#">Bad</a></li>
            <li role="presentation"><a href="#">Garten</a></li>
        </ul>

        <div id="article-row" class="row">

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href=""><img class="img-responsive" src="holder.js/360x210" alt="article"></a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href=""><img class="img-responsive" src="holder.js/360x210" alt="article"></a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href=""><img class="img-responsive" src="holder.js/360x210" alt="article"></a>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <button id="loadArticle" type="button" class="btn btn-primary btn-sm">show more</button>
        </div>


        <div class="page-header">
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

        </div>
    </div><!-- /.container -->

<?php require_once "footer.php"; ?>