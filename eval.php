<?php
include 'data-collector.php';
include 'index.php';

if (isset($_SESSION ['achievedPointsList'])){
    $achievedPointsList = $_SESSION['achievedPointsList'];
}

else {
    $achievedPointsList = array();
}

if (isset($_SESSION['maxPointslist'])) {
    $maxPointsList = $_SESSION ['maxPointsList'];
}

else {
    $maxPointsList = array();
}

$total = 0;

foreach ($achievedPointsList as $key => $value){
    $total += $value ;
}

$maxTotal = 0;

foreach ($maxPointsList as $key => $value){
    $maxTotal += $value ;
}

if ($total / $maxTotal >= 0.8){
    $exclamation = "WOW";
}
else if ($total / $macTotal >= 0.4){
    $exclamation = "Cool";
}
else {
    $exclamation = "That Sucks";
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
    <header></header>

    <main>
        <div>Your Scrore</div>
        <form action="index.php" method="post">
            <button type="submit">restart</button>
        </form>
    </main>

    <footer></footer>
</body>

</html>