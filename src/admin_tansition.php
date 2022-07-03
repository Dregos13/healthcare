<?php

session_start();

require_once("../classes/Database.php");

$conect = new Database();
$db = $conect->connect();

if (isset($_POST['activa'])){

    $id = $_POST['activa'];

    $bulk = new MongoDB\Driver\BulkWrite;

    $bulk->update(
        ['name' => $id],
        ['$set' => ['alta' => false]],
        ['multi' => false, 'upsert' => false]
    );

    $result = $db->executeBulkWrite('usuarios.user', $bulk);

    header("LOCATION: home_admin.php");

}

if (isset($_POST['inactiva'])){

    $id = $_POST['inactiva'];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['name' => $id],
        ['$set' => ['alta' => true]],
        ['multi' => false, 'upsert' => false]
    );

    $result = $db->executeBulkWrite('usuarios.user', $bulk);

    header("LOCATION: home_admin.php");


}

if (isset($_POST['borrar'])){


}

