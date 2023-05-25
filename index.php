<?php

require './Calc/CalcInterface.php';
require './Calc/PolishCalc.php';

$calc = new PolishCalc();
var_dump($calc->setExpression('3 4 +')->getResult());
var_dump($calc->setExpression('1 2 + 4 * 3 +')->getResult());
var_dump($calc->setExpression('7 3 4 - *')->getResult());
var_dump($calc->setExpression('10 15 - 3 *')->getResult());
var_dump($calc->setExpression('3 10 15 - *')->getResult());
var_dump($calc->setExpression('0 cos')->getResult());
var_dump($calc->setExpression('90 cos')->getResult());
var_dump($calc->setExpression('0 sin')->getResult());
var_dump($calc->setExpression('90 sin')->getResult());
var_dump($calc->setExpression('3 2 ^')->getResult());
