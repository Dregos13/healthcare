<?php
require_once ("../database/Database.php");

$conect = new Database();
$db = $conect->connect();

if (isset($_POST['username'])) {


    $name = $_POST['username'];
    $filter = ['name' => $name];
    $options = [];

    $query = new \MongoDB\Driver\Query($filter, $options);
    $cursor = $db->executeQuery("usuarios.user", $query);
    $cursor = $cursor->toArray();

    if (count($cursor) > 0) {

        echo "<script> console.log('Ya esta cogido'); </script>";
        echo "*Username taken";

    } else {

        echo "<script> console.log('No esta cogido'); </script>";
    }

}
if (isset($_POST['pass']) and isset($_POST['pass2'])) {

    if ($_POST['pass'] == $_POST['pass2']){

        echo "<script> console.log('coinciden'); </script>";

    }else{
        echo "*Passwords should be te same";
    }

}

if (isset($_POST['age'])) {

    if ($_POST['age'] > 18){

        echo "<script> console.log('coinciden'); </script>";

    }else{
        echo "*Maybe you are young for this app.";
    }

}


?>