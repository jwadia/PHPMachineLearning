<?php
include '../../../src/phpLearn/phpLearn.php';

$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$targets = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new SVC(true);
$classifier->train($samples, $targets);
$data = $classifier->predict([0,1.2]);

echo "<pre>";
print_r($data);
echo "</pre>";
?>

