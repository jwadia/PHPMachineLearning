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

class LeastSquares {
	private $data = array();
	private $output = false;
	
	function __construct($output) {
        $this->output = $output;
    }
	
	function train($samples, $labels) {
		$countSamples = count($samples);
		$countLabels = count($labels);
		if($countSamples == $countLabels) {
			for($x = 0; $x<$countSamples; $x++) {
				$this->data[] = [$labels[$x], $samples[$x][0]];
			}
		}
	}
	
	function predict($point) {
		$ysum = 0;
		$xsum = 0;
		$xx = 0;
		$yy = 0;
		
		foreach($this->data as $value) {
			$ysum += $value[0];
			$xsum += $value[1];
		}
		$ymean = $ysum/count($this->data);
		$xmean = $xsum/count($this->data);
		foreach($this->data as $value) {
			$xx += ($value[1]-$xmean)*($value[0]-$ymean);
			$yy += ($value[1]-$xmean)*($value[1]-$xmean);
		}
		$slope = $xx/$yy;
		$b = $ymean-($slope*$xmean);
		$y = ($slope*$point)+$b;
		if($this->output == true) {
			return array(round($y, 2), $b);
		} else {
			return array(round($y, 2));
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

class data {
	function iris() {
		$data = array('samples'=> '', 'labels' => '');
		$iris = array_map('str_getcsv', file('https://scansite.me/templates/ai/src/phpLearn/data/IRIS.csv'));
		foreach($iris as $value) {
			$data['samples'][] = array($value[0], $value[1], $value[2], $value[3]);
			$data['labels'][] = $value[4];
		}
		return $data;
	}
}
?>