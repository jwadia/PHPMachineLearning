<?php
class KNearestNeighbors {
	
	private $data = array();
	private $max = 0;
	private $output = false;
	private $predict = "";
		
	function __construct($max, $output) {
        $this->max = $max;
        $this->output = $output;
    }
	
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
		$this->data = $labels;
		$labels = key($labels);
		$this->predict = $labels;
		
		if ($this->output == true) {
			$average = new functions();
			$x = 0;
			$y = 0;
			foreach($this->data as $key => $value) {
				if ($x == 0) {
					$temp = $value;
				}
				$y += $value;
				$x++;
			}
			$out = array($this->predict, $average->average($temp,$y));
			return $out;
		} else {
			return array($this->predict);
		}
	}
}

class distance {
	function euclidean($point1, $point2){
		$countPoint1 = count($point1);
		$countPoint1 = count($point2);
		
		if($countSamples == $countPoint2) {
			for($x = 0; $x<$countPoint1; $x++) {
				$calc += ($point2[$x] - $point1[$x])*($point2[$x] - $point1[$x]);
			}
		}
				
		$calc = sqrt($calc);
		return $calc;
	}
}

class functions {
	function average($num1, $num2){
		$avg = round(($num1/$num2)*100, 3) . "%";
		return $avg;
	}
}
?>