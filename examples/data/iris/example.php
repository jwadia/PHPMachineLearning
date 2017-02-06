<?php
include '../../../src/phpLearn/phpLearn.php'; 

$iris = new data();
$data = $iris->iris();

$samples = $data['samples'];
$labels = $data['labels'];

echo '<pre>';
print_r($samples);
echo '<br>';
print_r($labels);
echo '</pre>';
?>