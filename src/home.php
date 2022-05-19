<?php
session_start();

require_once ("../database/Database.php");

$conect = new Database();
$db = $conect->connect();


?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../style/style.css">
    <title>Inicio Sesion</title>
</head>
<body class="img js-fullheight" style="background-color: #00aaaa;">


</body>
</html>