<?php

//Inilieze session.
session_start();


function getQuestions()
{

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

    return $questions;
}

// check if $_SESSION questions exists
if (!isset($_SESSION['questions'])) {
    // echo questions data EXISTS in session <br>`;

    //..... and save data in $_SESSION
    $_SESSION['questions'] = getQuestions();
}
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

    <main>
        <div>Welcome To Quiz Plus</div>
        <form action="/q1.php" method="post">

            <button type="submit">Start</button>
        </form>
    </main>
</body>

</html>