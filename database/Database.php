<?php

class Database
{


    public function connect(){

        $connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");

        if ($connection){

            echo "Se ha conectado";

        }else{

            echo "nada";
        }

        return $connection;
   }

   public function query(){

       $query = new Mongodb\Driver\Query([]);

       return $query;
   }

}