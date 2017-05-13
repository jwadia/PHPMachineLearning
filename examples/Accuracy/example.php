<?php
include '../../src/phpLearn/phpLearn.php';

$accuracy = new Accuracy();
echo $accuracy->score(['a', 'b', 'a'], ['a', 'a', 'a']);
?>