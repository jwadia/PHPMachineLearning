<?php
include '../../../src/phpLearn/phpLearn.php';

$samples = [[60], [61], [62], [63], [65]];
$targets = [3.1, 3.6, 3.8, 4, 4.1];

$classifier = new LeastSquares(true);
$classifier->train($samples, $targets);
$data = $classifier->predict(64);

echo "<pre>";
print_r($data);
echo "</pre>";
?>