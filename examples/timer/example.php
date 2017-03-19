<?php 
include '../../src/phpLearn/phpLearn.php';
$timer = new timer();
$timer->start();
$timer->finish();
echo $timer->runtime();
?>