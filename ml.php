<?php
class KNearestNeighbors {
	
	public $data = array();
	public $max = 3;
	
	function train($samples, $labels) {
		$countSamples = count($samples);
		$countLabels = count($labels);
		if($countSamples == $countLabels) {
			for($x = 0; $x<$countSamples; $x++) {
				$this->data[] = [$labels[$x], $samples[$x]];
			}
		}
	}
	
	function predict($point) {
		$d = array();
		$labels = array();
		$distance = new distance();
		foreach($this->data as $value) {
			$d[rand(1000,9999) . '-' . $value[0]] = $distance->euclidean($point, [$value[1][0], $value[1][1]]);
			$labels[$value[0]] = 0;
		}
		asort($d);	
		$i = 0;
		foreach ($d as $key => $value) {
			$key = substr($key, 5);
			foreach($labels as $key2 => $value2) {
				if($i-2 <= $this->max) {
					if ($key2 == $key) {
						$labels[$key2] = $value2+1;
					}
					$i++;
				}
			}
		}
		arsort($labels);
		$labels = key($labels);
		return $labels;
	}
}

class distance {
	function euclidean($point1, $point2){
		$calc = (($point2[0] - $point1[0])*($point2[0] - $point1[0]))+(($point2[1] - $point1[1])*($point2[1] - $point1[1]));
		$calc = sqrt($calc);
		return $calc;
	}
}


$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);
echo $classifier->predict([3, 2]);
?>