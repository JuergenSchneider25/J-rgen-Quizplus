<?php
session_start();

include 'data-collector.php';
include 'eval.php';
//Evaluate data in $_POST variable.
$currentQuestionIndex = 0;

if (isset($_POST['lastQuestionIndex'])) {
    $lastQuestionIndex = $_POST['lastQuestionIndex'];

    if (isset($_POST['nextQuestionIndex'])) {
        $currentQuestionIndex = $_POST['nextQuestionIndex'];
    }
}

//Check is $_SESSION['questions'] exists.
if (isset($_SESSION['questions'])) {
    //echo 'questions data EXISTS in session.<br>';
    //$questions = getQuestions();
    $questions = $_SESSION['questions'];
} else {
    //  echo 'questions data does NOT exist in session.<br>';//

    //Get questions data from database using php/db.php...
    $questions = getQuestions();

    //...and save that data in $_SESSION.
    $_SESSION['questions'] = $questions;
}

//DevOnly: Debug output to see what is inside the array $question
//print "<pre>";
//print_r($_SESSION['questions']);
//echo '</pre>';
?>

<div class="row">
    <div class="col-sm-12">

        <h3> Frage <?php echo $currentQuestionIndex; ?> </h3>
        <p><?php echo $questions[$currentQuestionIndex]['Text']; ?></p>

        <form <?php if ($currentQuestionIndex +1 == count ($questions)) echo 'action="result.php" '; ?> method="post">
        <?php 
            $answers = $questions[$currentQuestionIndex] ['Answers'];
            $type = $questions [$currentQuestionIndex]['Type'];

            for ($answer = 0; $a <count($answers); $answer++) {
                echo '<div class="form-check">';
                $IsCorrectAnswer = $answers[$a] ['IsCorrectAnswer'];
                
                if ($IsMultipleChoice == 1){
                
                    echo 'input type="checkbox" class="form-check-input" id=i-' . $a .'" name="a-' . $a . '" value "' - $IsCorrectAnswer .'" >';
                }
                else  {
               
                    echo 'input type="radio" class="form-check-input" id=i-' . $a .'" name="a-0' . $a . '" value "' - $IsCorrectAnswer .'" >';
            }

            $maxPoints += $IsCorrectAnswer; 
                
            echo '<label class="form-check-label" for ="i-' . $a . '">';
            echo $answers[$a]['Text'];
            echo '</label>';
            echo '</div>';
        }   
        ?>
            
            <input type="hidden" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex;?>">
            <input type="hidden" name="nextQuestionIndex" value="<?php echo $currentQuestionIndex + 1; ?>">
            <input type="hidden" name="maxPoints" value="<?php echo $maxPoints; ?>">
            
            <p class="warning"></p>
            <input type="submit">
        </form>
    </div>
</div>


<?php
$question = $_SESSION['questions'][0]['Text'];
$answer1 = $_SESSION['questions'][0]['answers'][0]['Text'];
$answer2 = $_SESSION['questions'][0]['answers'][1]['Text'];
$answer3 = $_SESSION['questions'][0]['answers'][2]['Text'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <header></header>

    <main>
        <div><?= $question ?></div>
        <form action="/q2.php" method="post">
            <input type="checkbox" name="" id="q1">
            <label for="q1"><?= $answer1 ?></label>
            <input type="checkbox" name="" id="q2">
            <label for="q2"><?= $answer2 ?></label>
            <input type="checkbox" name="" id="q3">
            <label for="q3"><?= $answer3 ?></label>
            <button type="submit">Next</button>
        </form>
    </main>

    <footer></footer>

</body>

</html>