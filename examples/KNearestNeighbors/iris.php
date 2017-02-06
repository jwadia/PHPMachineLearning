<?php
include '../../src/phpLearn/phpLearn.php';

$iris = new data();
$data = $iris->iris();

$samples = $data['samples'];
$labels = $data['labels'];

$classifier = new KNearestNeighbors(5, true);
$classifier->train($samples, $labels);
$data = $classifier->predict([5, 3.4, 1.6, 0.4]);

echo "<pre>";
print_r($data);
echo "</pre>";
?>
