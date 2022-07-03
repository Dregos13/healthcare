<?php

class Database
{


    public function connect(){

        $connection = new MongoDB\Driver\Manager("mongodb://localhost:37017");

        return $connection;
   }

   public function query(){

       $query = new Mongodb\Driver\Query([]);

       return $query;
   }

}