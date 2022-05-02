<?php
session_start();

if (isset($_POST['lastQuestionIndex'])) {
    $questionKey = 'question' . $lastQuestionIndex;

    $achievedPoints = 0;

    foreach ($_POST as $key => $value) {
        if (str_contains($key, 'answers')) {
            $achievedPoints += intval($value);
        }
    }
}

if (!isset ($_SESSION['achievedPointsList'])){
    $_SESSION['achievedPointsList']= array();
}

$_SESSION['achievedPointsList'][$questionKey]=$achievedPoints;

$maxPoints = intval($_POST['maxPoints']);

if(!isset($_SESSION['maxPointsList'])){
    $_SESSION['maxPointsList'] = array ();
}

$_SESSION ['maxPointsList'][$questionkey]=$maxPoints;
