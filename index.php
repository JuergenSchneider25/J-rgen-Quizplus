

<?php


session_start();


function getQuestions()
{

   
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $dbHost = getenv('DB_HOST');

    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

  
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $query = $dbConnection->query("SELECT * from Questions");

    $questions = $query->fetchAll(PDO::FETCH_ASSOC);

   

    foreach ($questions as $key => $question) {

       
        $subQuery = $dbConnection->prepare("SELECT * from Answer where Answer.QuestionId = ? ");
        $subQuery->bindValue(1, $question['ID']);
        $subQuery->execute();
        $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);
        $questions[$key]['answers'] = $answers;
    }

    return $questions;
}

if (!isset($_SESSION['questions'])) {
    


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