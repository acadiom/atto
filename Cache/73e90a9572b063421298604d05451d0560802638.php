<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Sticky Footer Navbar Template for Bootstrap</title>

    <!-- Font awesome icons -->
    <link href="<?php echo $__env->e($link->resource('css/fontawesome-4.7.0.css')); ?>" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $__env->e($link->resource('css/bootstrap-3.3.7.css')); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $__env->e($link->resource('css/application.css')); ?>" rel="stylesheet">

  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Application</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Error Codes</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <!-- Begin page content -->
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>


    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $__env->e($link->resource('js/jquery-1.12.4.js')); ?>"></script>
    <script src="<?php echo $__env->e($link->resource('js/bootstrap-3.3.7.js')); ?>"></script>
    <script src="<?php echo $__env->e($link->resource('js/application.js')); ?>"></script>
  </body>
</html>