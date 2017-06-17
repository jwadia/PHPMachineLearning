<?php
include '../../src/phpLearn/phpLearn.php';

$iris = new Data();
$data = $iris->iris();

$samples = $data['samples'];
$labels = $data['labels'];

$classifier = new NeuralNetwork([3,4,3], ['setosa', 'versicolor', 'virginica'], true);
$classifier->train($samples, $labels);
$data = $classifier->predict([5.9,3.0,5.1,1.8]);

echo "<pre>";
print_r($data);
echo "</pre>";

?>