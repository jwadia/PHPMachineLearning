<?php
include '../../../src/phpLearn/phpLearn.php';

$classifier = new distance();
echo $classifier->euclidean([5.1, 3.5, 1.4, 0.2], [55, 5, 150, 0.2]);
?>