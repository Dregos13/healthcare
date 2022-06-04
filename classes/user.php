<?php

require_once ("../classes/Database.php");


class user{

    public function sign_in($user){

        $conect = new Database();

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($user);

        $db = $conect->connect();

        $db->executeBulkWrite('usuarios.user', $bulk);

    }

}