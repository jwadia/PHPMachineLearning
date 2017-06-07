<?php
include '../../../src/phpLearn/phpLearn.php';

$samples = [[3], [6], [10], [5], [2]];
$targets = [2,5,7,9,12];

$classifier = new QuadraticRegression(true);
$classifier->train($samples, $targets);
$data = $classifier->predict(8);

echo "<pre>";
print_r($data);
echo "</pre>";
?>