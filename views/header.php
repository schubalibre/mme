<nav class="navbar navbar-default <?php echo ($viewModel->get("site") == "home") ? "navbar-fixed-bottom" : "navbar-fixed-top smaller"; ?> ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home">
                <img src="/images/logoneu.png" alt="logo">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#home">Home</a></li>
                <li><a href="#rooms">Rooms</a></li>
                <li><a href="#articles">Articles</a></li>
                <li><a id="login" href="/backend/login">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php ($viewModel->get("slider")) ? require($viewModel->get("slider")): false ; ?>