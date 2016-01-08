<!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="de"> <![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="de"> <![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="de"> <![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="de"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $viewModel->get('pageTitle'); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
    <script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body id="<?php echo $viewModel->get("site"); ?>">

<?php require($viewModel->get("header")); ?>

<div class="container">
    <div class="row">
        <?php require($this->viewFile); ?>
    </div>
</div>

<?php require($viewModel->get("footer")); ?>

<!-- modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-conten">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <div class='row'>
            <div class='col-sm-6 modal-img'> </div>
            <div class='col-sm-6'>
                <div class="modal-header">
                    <h1 class="modal-title">Modal title</h1>
                </div>
                <div class="modal-body"></div>
            </div>

        </div>
    </div>
</div><!-- /.modal -->

<!-- login modal -->
<div id="loginModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Login</h4>
            </div>
            <form id="loginForm" action="/backend/login" method="post">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email"  id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-corporate">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script src="/js/vendor/holder.min.js"></script>
<script src="/js/vendor/masonry.pkgd.min.js"></script>
<script src="/js/main.js"></script>

</body>
</html>