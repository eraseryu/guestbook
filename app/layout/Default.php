<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="public/css/application.css" rel="stylesheet" media="screen">

    <!--[if lt IE 9]>
    <script src="public/assets/js/html5shiv.js"></script>
    <script src="public/assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/application.js"></script>
</head>
<body>
    <div id="wrapper" class="container">
        <header class="page-header">
            <h1><a href="?controller=Book&method=show" style="text-decoration: none !important;">Cool guestbook <small>by Milan Petrovic</small></a></h1>
        </header>
        <nav role="navigation" class="clearfix">
            <ul class="nav nav-pills">
                <?php if($this->isLoggedIn): ?>
                <li>
                    <a href="?controller=Book&method=add">
                        <span class="glyphicon glyphicon-plus-sign"></span> Add new
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="?controller=User&method=login">
                        <span class="glyphicon glyphicon-user"></span>
                        <?php if($this->isLoggedIn): ?>Logout <?php echo $this->username; else: ?>Login<?php endif; ?>
                    </a>
                </li>
            </ul>
        </nav>
        <article class="clearfix">
            <?php echo $this->mvc; ?>
        </article>
    </div>
</body>
</html>