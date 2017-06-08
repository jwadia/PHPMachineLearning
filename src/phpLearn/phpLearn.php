<?php
class KNearestNeighbors {
	private $output = false;
	private $data = array();
	private $max = 0;
		
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
		$timer = new Timer();
		$timer->start();
		$d = array();
		$labels = array();
		$distance = new Distance();
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
		$predict = $labels;
		
		if ($this->output == true) {
			$average = new Functions();
			$x = 0;
			$y = 0;
			foreach($this->data as $key => $value) {
				if ($x == 0) {
					$temp = $value;
				}
				$y += $value;
				$x++;
			}
			$timer->finish();
			$out = array($predict, $average->average($temp,$y), $timer->runtime());
			return $out;
		} else {
			$timer->finish();
			return array($predict);
		}
	}
}

class LeastSquares {
	private $data = array();
	private $output = false;
	private $m = 0;
	private $b = 0;
	
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
		$this->m = $xx/$yy;
		$this->b = $ymean-($this->m*$xmean);
	}
	
	function predict($point) {
		$timer = new Timer();
		$timer->start();
		$y = ($this->m*$point)+$this->b;
		if($this->output == true) {
			$timer->finish();
			return array(round($y, 2), $this->b, $timer->runtime());
		} else {
			$timer->finish();
			return array(round($y, 2));
		}
	}
}

class MultipleLinearRegression {
	private $data = array();
	private $output = false;
	private $m1 = 0;
	private $m2 = 0;
	private $b = 0;
	function __construct($output) {
        $this->output = $output;
    }
	
	function train($samples, $labels) {
		$countSamples = count($samples);
		$countLabels = count($labels);
		if($countSamples == $countLabels) {
			for($x = 0; $x<$countSamples; $x++) {
				$this->data[] = [$labels[$x], $samples[$x][0], $samples[$x][1]];
			}
		}
		$n = count($this->data);
		$y = 0;
		$x1 = 0;
		$x12 = 0;
		$x2 = 0;
		$x22 = 0;
		$x1y = 0;
		$x2y = 0;
		$x1x2 = 0;
		foreach($this->data as $value) {
			$x12 += pow($value[1], 2);
			$x22 += pow($value[2], 2);
			$y += $value[0];
			$x1 += $value[1];
			$x2 += $value[2];
			$x1y += $value[1]*$value[0];
			$x2y += $value[2]*$value[0];
			$x1x2 += $value[1]*$value[2];
		}
		$x1y = $x1y-(($x1*$y)/$n);
		$x2y = $x2y-(($x2*$y)/$n);
		$x1x2 = $x1x2-(($x1*$x2)/$n);
		
		$this->m1 = ((($x22 - (pow($x2,2)/$n))*$x1y)-($x1x2*$x2y))/((($x12 - (pow($x1,2)/$n))*($x22 - (pow($x2,2)/$n)))-pow($x1x2,2));
		$this->m2 = ((($x12 - (pow($x1,2)/$n))*$x2y)-($x1x2*$x1y))/((($x12 - (pow($x1,2)/$n))*($x22 - (pow($x2,2)/$n)))-pow($x1x2,2));
		$this->b = ($y/$n)-($this->m1*($x1/$n))-($this->m2*($x2/$n));
	}
	
	function predict($point) {
		$timer = new Timer();
		$timer->start();
		$y = ($this->m1*$point[0])+($this->m2*$point[1])+$this->b;
		
		if($this->output == true) {
			$timer->finish();
			return array(round($y, 2), $this->b, $timer->runtime());
		} else {
			$timer->finish();
			return array(round($y, 2));
		}
	}
}

class QuadraticRegression {
	private $data = array();
	private $output = false;
	private $a = 0;
	private $b = 0;
	private $c = 0;
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
		$n = count($this->data);
		$x = 0;
		$x2 = 0;
		$x3 = 0;
		$x4 = 0;
		$xy = 0;
		$x2y = 0;
		$y = 0;
		foreach($this->data as $value) {
			$x += $value[0];
			$y += $value[1];
			$x2 += pow($value[0], 2);
			$x3 += pow($value[0], 3);
			$x4 += pow($value[0], 4);
			$xy += ($value[0]*$value[1]);
			$x2y += (pow($value[0], 2)*$value[1]);
		}
		$xx = ($x2-(pow($x, 2)/$n));
		$xy = ($xy-(($x*$y)/$n));
		$xx2 = ($x3-(($x2*$x)/$n));
		$x2y = ($x2y-(($x2*$y)/$n));
		$x2x2 = ($x4-((pow($x2, 2))/$n));
		
		$this->a = (($x2y*$xx)-($xy*$xx2))/(($xx*$x2x2)-pow($xx2, 2));
		$this->b = (($xy*$x2x2)-($x2y*$xx2))/(($xx*$x2x2)-pow($xx2, 2));
		$this->c = (($y / $n)-($this->b*($x/$n))-($this->a*($x2/$n)));
	}
	
	function predict($point) {
		$timer = new Timer();
		$timer->start();
		
		$y = ($this->a*pow($point, 2))+$this->b*$point+$this->c;
		
		if($this->output == true) {
			$timer->finish();
			return array(round($y, 2), $this->c, $timer->runtime());
		} else {
			$timer->finish();
			return array(round($y, 2));
		}
	}
}

class SVC {
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
				$this->data[] = [$labels[$x], $samples[$x]];
			}
		}
	}
	function predict($point) {
		$timer = new Timer();
		$timer->start();
		$slopef = 0;
		$bf = 0;
		$list = array();
		
		foreach($this->data as $value) {
			if(!in_array($value[0], $list)) {
				$list[] = $value[0];
			}
		}
		$list = array_unique($list);
		foreach($list as $sample) {
			$count = 0;
			$ysum = 0;
			$xsum = 0;
			$xx = 0;
			$yy = 0;
			foreach($this->data as $value) {
				if($sample[0] != $value[0]) {
					$count++;
					$ysum += $value[1][0];
					$xsum += $value[1][1];
				}
			}
			$ymean = $ysum/$count;
			$xmean = $xsum/$count;
			foreach($this->data as $value) {
				if($sample[0] != $value[0]) {
					$xx += ($value[1][1]-$xmean)*($value[1][0]-$ymean);
					$yy += ($value[1][1]-$xmean)*($value[1][1]-$xmean);
				}
			}
			$slope = $xx/$yy;
			$b = $ymean-($slope*$xmean);
			for ($x = 0; $x < count($list); $x++) {
				if($sample[0] == $list[$x][0]) {
					$list[] = [$slope, $b];
				}
			}
			$slopef += $slope;
			$bf += $b;
		}	
		$slopef /= 2; 
		$bf /= 2; 
		
		$s1 = ($slopef*($point[0]))+$bf;
		$s1 = ($point[1])-($s1);
		if($s1 < 0) {
			if($list[2][1] < $list[3][1]) {
				if($this->output == true) {
					$timer->finish();
					return array($list[0], $timer->runtime());
				} else {
					$timer->finish();
					return array($list[0]);
				}
			} else {
				if($this->output == true) {
					$timer->finish();
					return array($list[1], $timer->runtime());
				} else {
					$timer->finish();
					return array($list[1]);
				}
			}
		} else {
			if($list[2][1] > $list[3][1]) {
				if($this->output == true) {
					$timer->finish();
					return array($list[0], $timer->runtime());
				} else {
					$timer->finish();
					return array($list[0]);
				}
			} else {
				if($this->output == true) {
					$timer->finish();
					return array($list[1], $timer->runtime());
				} else {
					$timer->finish();
					return array($list[1]);
				}
			}
		}
	}

}

class Distance {
	function euclidean($point1, $point2){
		$calc = 0;
		$countPoint1 = count($point1);
		$countPoint2 = count($point2);
		
		if($countPoint1 == $countPoint2) {
			for($x = 0; $x<$countPoint1; $x++) {
				$calc += ($point2[$x] - $point1[$x])*($point2[$x] - $point1[$x]);
			}
		}
				
		$calc = sqrt($calc);
		return $calc;
	}
}

class Functions {
	function average($num1, $num2){
		$avg = round(($num1/$num2)*100, 3) . "%";
		return $avg;
	}
}

class Timer {
	private $start;
	private $finish;
	
	function start(){
		$this->start = microtime(true);
	}
	
	function finish(){
		$this->finish = microtime(true);
	}
	
	function runtime() {
		return ($this->finish-$this->start)*10;
	}
}

class Data {
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

class Accuracy {
	function score($actual, $predicted) {
		$total = 0;
		$count = 0;
		if(count($actual) == count($predicted)) {
				for ($x = 0; $x < count($actual); $x++) {
					$total++;
					if($actual[$x] == $predicted[$x]) {
						$count++;
					}
				}
		}
		return $count/$total;
	}
}
?>