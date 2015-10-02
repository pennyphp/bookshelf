<?php $this->layout('layout', ["title" => "Internal Server Error"]) ?>

<div class="container">
  <div class="header clearfix">
    <h3 class="text-muted"><a href="https://github.com/pennyphp/penny-classic-app">Penny Classic Application</a></h3>
  </div>

  <div class="row">
    <div class="col-md-12 center-block">
        <img src="/img/500.png" class="img-responsive"/>
    </div>
  </div>

  <div class="jumbotron">
    <h2><?php echo get_class($exception) ?></h2>
    <?php foreach ($exception->getTrace() as $single) { ?>
    <p><?php echo $single['file'] ?> <strong><?php echo $single['line'] ?></strong> -><?php echo $single['function'] ?>
    <?php } ?>
  </div>

</div>
