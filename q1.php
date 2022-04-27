<?php
session_start();

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
        <div><?=$question?></div>
        <form action="/q2.php" method="post">
            <input type="checkbox" name="" id="q1">
            <label for="q1"><?=$answer1?></label>
            <input type="checkbox" name="" id="q2">
            <label for="q2"><?=$answer2?></label>
            <input type="checkbox" name="" id="q3">
            <label for="q3"><?=$answer3?></label>
            <button type="submit">Next</button>
        </form>
    </main>

    <footer></footer>

</body>

</html>