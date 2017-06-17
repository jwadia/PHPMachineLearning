# PHPLearn - Machine Learning Library for PHP


## Contents
- [Installation](https://github.com/jwadia/PHPMachineLearning#installation)
- [Features](https://github.com/jwadia/PHPMachineLearning#features)
- [Documentation](https://github.com/jwadia/PHPMachineLearning#documentation)
    - [Accuracy Class](https://github.com/jwadia/PHPMachineLearning#accuracy)
        - [Score](https://github.com/jwadia/PHPMachineLearning#score)
    - [KNearestNeighbors](https://github.com/jwadia/PHPMachineLearning#knearestneighbors)
    - NuralNetwork
    - [Data Class](https://github.com/jwadia/PHPMachineLearning#data)
        - [Iris](https://github.com/jwadia/PHPMachineLearning#iris)
    - [Distance Class](https://github.com/jwadia/PHPMachineLearning#distance)
        - [Euclidean Distance](https://github.com/jwadia/PHPMachineLearning#euclidean)
    - [LeastSquares](https://github.com/jwadia/PHPMachineLearning#leastsquares)
    - [Multiple Linear Regression](https://github.com/jwadia/PHPMachineLearning#multiple-linear-regression)
    - [Quadratic Regression](https://github.com/jwadia/PHPMachineLearning#quadratic-regression)
    - [Support Vector Classification](https://github.com/jwadia/PHPMachineLearning#support-vector-classification)
    - [Timer Class](https://github.com/jwadia/PHPMachineLearning#timer)
- [Licence](https://github.com/jwadia/PHPMachineLearning#licence)
- [Author](https://github.com/jwadia/PHPMachineLearning#author)

## Installation

PHPLearn requires PHP >= 7.0

To install PHPLearn download the contents of the phpLearn directory into your webserver and create and include the 'phpLearn.php' file in all your PHP scripts.

```
include_once 'phpLearn.php';
```

## Features

- Classification
    - [KNearestNeighbors](https://github.com/jwadia/PHPMachineLearning#knearestneighbors)
    - [Support Vector Classification](https://github.com/jwadia/PHPMachineLearning#support-vector-classification)
- Regression
    - [LeastSquares](https://github.com/jwadia/PHPMachineLearning#leastsquares)
    - [Multiple Linear Regression](https://github.com/jwadia/PHPMachineLearning#multiple-linear-regression)
    - [Quadratic Regression](https://github.com/jwadia/PHPMachineLearning#quadratic-regression)
- Nural Network
- Helper Classes
    - [Accuracy Class](https://github.com/jwadia/PHPMachineLearning#accuracy)
		- [Score](https://github.com/jwadia/PHPMachineLearning#score)
    - [Data Class](https://github.com/jwadia/PHPMachineLearning#data)
        - [Iris Dataset](https://github.com/jwadia/PHPMachineLearning#iris)
    - [Distance Class](https://github.com/jwadia/PHPMachineLearning#distance)
		- [Euclidean Distance](https://github.com/jwadia/PHPMachineLearning#euclidean)
    - [Timer Class](https://github.com/jwadia/PHPMachineLearning#timer)

## Documentation

#### KNearestNeighbors

A machine learning classifier implementing the KNearestNeighbors algorithm.

##### Constructor 

- $k - number of nearest neighbors to scan
- $verbose
    - true - output predicted label, percent confidence, and runtime
    - false - output predicted label
```
$classifier = new KNearestNeighbors($k, $verbose);
```

##### Train

To train the KNearestNeighbors classifier provide train samples and labels as type array.

Example:
```
$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$targets = ['a', 'a', 'a', 'b', 'b', 'b'];
$classifier = new KNearestNeighbors(3, false);
$classifier->train($samples, $targets);
```

##### Predict

To predict a label use the 'predict' method.
```
$data = $classifier->predict([3, 2]);

// return 'b'
```

#### Support Vector Classification

A machine learning classifier implementing the SVC algorithm.

##### Constructor 

- $verbose
    - true - output predicted label, and runtime
    - false - output predicted label
```
$classifier = new SVC($verbose);
```

##### Train

To train the KNearestNeighbors classifier provide train samples and labels as type array.

Example:
```
$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 2], [4, 2]];
$targets = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new SVC(true);
$classifier->train($samples, $targets);
```

##### Predict

To predict a label use the 'predict' method.
```
$data = $classifier->predict([0,1.2]);

// return 'b'
```

#### LeastSquares

A machine learning classifier implementing the LeastSquares method of Linear Regression.

##### Constructor 

- $verbose
    - true - output predicted label, y-intercept, and runtime
    - false - output predicted label
```
$classifier = new LeastSquares($verbose);
```

##### Train

To train the LeastSquares classifier provide train samples and labels as type array.

Example:
```
$samples = [[60], [61], [62], [63], [65]];
$targets = [3.1, 3.6, 3.8, 4, 4.1];

$classifier = new LeastSquares(true);
$classifier->train($samples, $targets);
```

##### Predict

To predict a label use the 'predict' method.
```
$data = $classifier->predict(64);

// return 4.06
```

#### Multiple Linear Regression

A machine learning classifier implementing Multiple Linear Regression.

##### Constructor 

- $verbose
    - true - output predicted label, y-intercept, and runtime
    - false - output predicted label
```
$classifier = new MultipleLinearRegression($verbose);
```

##### Train

To train the Multiple Linear Regression classifier provide train samples and labels as type array.

Example:
```
$samples = [[73676, 1996], [77006, 1998], [10565, 2000], [146088, 1995], [15000, 2001], [65940, 2000], [9300, 2000], [93739, 1996], [153260, 1994], [17764, 2002], [57000, 1998], [15000, 2000]];
$targets = [2000, 2750, 15500, 960, 4400, 8800, 7100, 2550, 1025, 5900, 4600, 4400];

$classifier = new MultipleLinearRegression(true);
$classifier->train($samples, $targets);
```

##### Predict

To predict a label use the 'predict' method.
```
$data = $classifier->predict([60000, 1996]);

// return 4094.83
```

#### Quadratic Regression

A machine learning classifier implementing MQuadratic Regression.

##### Constructor 

- $verbose
    - true - output predicted label, y-intercept, and runtime
    - false - output predicted label
```
$classifier = new MultipleLinearRegression($verbose);
```

##### Train

To train the Quadratic Regression classifier provide train samples and labels as type array.

Example:
```
$samples = [[3], [6], [10], [5], [2]];
$targets = [2,5,7,9,12];

$classifier = new QuadraticRegression(true);
$classifier->train($samples, $targets);
```

##### Predict

To predict a label use the 'predict' method.
```
$data = $classifier->predict(8);

// return 7.39
```

#### Accuracy

A helper class letting you easily calculate the accuracy of predicted data.

##### Score

To predict a score provide labels and predicted labels as type array.

```
$accuracy = new Accuracy();
$accuracy->score(['a', 'b', 'a'], ['a', 'a', 'a']);

return 0.666
```

#### Data

A helper class letting you easily parse training data into arrays.

##### Iris

Sets an associative array with the samples and labels.

```
$iris = new Data();
$data = $iris->iris();

$samples = $data['samples'];
$labels = $data['labels'];
```

#### Distance

A helper class letting you easily get the distance between two data points.

##### Euclidean

Gets the euclidean distance between two points

```
$classifier = new distance();
$classifier->euclidean([5.1, 3.5, 1.4, 0.2], [55, 5, 150, 0.2]);

//return 156.76166623253
```

#### Timer

A helper class letting you easily get the runtime of a script.

```
$timer = new timer();
$timer->start();
$timer->finish();
$timer->runtime();

//return 0.00000000546
```

## Licence

PHPLearn is released under the MIT Licence.

## Author

Jehan Wadia (@jwadia)
