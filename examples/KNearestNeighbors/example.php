<?php
include '../../src/phpLearn/phpLearn.php';

$samples = [[5.1, 3.5], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new KNearestNeighbors(3, true);
$classifier->train($samples, $labels);
$data = $classifier->predict([2, 4]);

echo "<pre>";
print_r($data);
echo "</pre>";
?>