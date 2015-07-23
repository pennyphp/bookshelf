<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <title><?php echo $this->e($title) ?></title>

        <!-- Bootstrap core CSS -->
        <link href="/vendor/css/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <![endif]-->
  </head>

    <body>

        <?php echo $this->section('content') ?>

        <footer class="footer-area">
            <div class="footer-top">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-md-12">
                        </div>
                </div>
            </div>

        </footer>

        <script type="text/javascript" src="/vendor/js/bower_components/jquery/dist/jquery.js"></script><!-- jquery -->
        <script type="text/javascript" src="/vendor/js/bower_components/bootstrap/dist/js/bootstrap.js"></script><!-- Bootstrap Js -->
        <?=$this->section('inline-script')?>

    </body>
</html>
