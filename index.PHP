<?php

require_once ("./database/Database.php");

header("LOCATION: src/login.php");



if(extension_loaded("mongodb")) {


    try {
        
        $conect = new Database();
        
        $db = $conect->connect();
        $query = $conect->query();


        $cursor = $db->executeQuery("usuarios.user", $query);

        $usuario = $cursor->toArray();

        echo "<br>";

        foreach ($usuario as $user) {

            print ($user->_id);

            echo "<br>";

            print ($user->name);

            echo "<br>";


        }

    } catch (MongoConnectionException $e){

        var_dump($e);
    }

}else{

    echo "No ta";
}


?>