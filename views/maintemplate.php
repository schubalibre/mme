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
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <?php require($this->viewFile); ?>
    </div>
</div>

<!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script src="/js/main.js"></script>

</body>
</html>