<?php

namespace Core;
use PDO;
use PDOException;

class Model
{
    /**
     * Connect to database using PDO
     * Settings from dotenv are used to connect to database
     */
    protected function connect():PDO
    {
        try {
            $options = [];
            $conn = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'].";charset=utf8;port=".$_ENV['DB_PORT'].";", $_ENV['DB_USER'], $_ENV['DB_PASSWORD'],$options);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * execute a database query
     */
    public function dbQuery(string $pdo_prepaired_query, array $pdo_field_variables):array
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare($pdo_prepaired_query);
        $stmt->execute($pdo_field_variables);

        //if query is not a select no need to fetch the data
        if(substr(strtolower($pdo_prepaired_query),0,6) != 'select'){
            return [];
        }else{
            return $stmt->fetchAll();
        }
    }
}


