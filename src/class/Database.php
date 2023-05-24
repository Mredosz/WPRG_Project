<?php

class Database
{
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dataBase = "project";

    static function connect(){
        return mysqli_connect(self::$host, self::$username, self::$password, self::$dataBase);
    }

   static function disconnect(){
        return mysqli_close(self::connect());
   }

    static function query($query){
        $conn = self::connect();
        return mysqli_query($conn, $query);
    }

   static function numRows($result){
        return mysqli_num_rows($result);
   }

    static function realString($result){
        $conn = Database::connect();
        return trim(mysqli_real_escape_string($conn, $result));
    }

}