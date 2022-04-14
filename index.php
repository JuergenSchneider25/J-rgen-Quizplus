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
        <div>Welcome To Quiz Plus</div>
        <form action="/q1.php" method="post">

            <button type="submit">Start</button>
        </form>
    </main>


    <footer></footer>

    <?php
    echo "QuizzPlus!";
    ?>
    <?php

    // connect to mySQL database using PHP PDO Object
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $dbHost = getenv('DB_HOST');

    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

    // the following tells PDO we want it to throw Exceptions for every error.
    // this is far more useful than the default mode of throwing php errors.
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create a multidimensional array with questions
    // holding also the answers to each questions

    $query = $dbConnection->query("SELECT * from Questions");

    $questions = $query->fetchAll(PDO::FETCH_ASSOC);

    // print_r($questions);

    foreach ($questions as $key => $question) {
        // prepare an SQL statement with a placeholder ? the help of the db connection $dbConnection
        $subQuery = $dbConnection->prepare("SELECT * from Answer where Answer.QuestionId = ? ");
        $subQuery->bindValue(1, $question['ID']);
        $subQuery->execute();
        $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);
        $questions[$key]['answers'] = $answers;
    }

    //DevOnly: Debug output to see what is inside the array $question
    print "<pre/>";
    print_r($questions);
    exit();


    ?>

<div class ="row">
        <div class="col-sm-12">
        <h3> Frage <?php echo $currentQuestionIndex;?></h3>
        <p><?php echo $questions[$currentQuestionIndex]['text']; ?></p>
            <form method="post>">
                <div class="form-check">
                    <input class="form-check-input" type = "checkbox" value ="0" id="flexCheckDefault">
                    <label class="form-check-label" for = "flexCheckDefault">
                    <?php
                        $Answers = $questions[$currentQuestionIndex]['Answers'];
                        $Answers = $Answers[0];
                        echo $Answers['Answer'];
                        ?>
                        </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked";
                            label class="form-check-label" for="flexCheckChecked">
                            <?php
                            $answers = $questions[$currentQuestionIndex]['answers'];
                            echo $answers[1]['answer'];
                        ?>
                        </label>


                <input types="hidden" names="lastQuestionIndex" value=" <?php echo $currentQuestionIndex;?>">
                <input types="hidden" names="nextQuestionIndex" value=" <?php echo $currentQuestionIndex + 1;?>">
                    



</body>j
</html>