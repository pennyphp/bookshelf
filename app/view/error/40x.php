<?php $this->layout('layout', ["title" => $title]) ?>

<div class="container">
  <div class="header clearfix">
    <h3 class="text-muted"><a target="_blank" href"="https://github.com/gianarb/penny-classic-app">Penny Classic Application</a></h3>
  </div>


<div class="jumbotron">
    <h2><?php echo get_class($exception) ?></h2>
    <?php foreach ($exception->getTrace() as $single) { ?>
    <p><?php echo $single['file'] ?> <strong><?php echo $single['line'] ?></strong> -><?php echo $single['function'] ?>
    <?php } ?>
  </div>

</div>
