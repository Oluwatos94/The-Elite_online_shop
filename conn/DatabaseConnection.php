<?php

$host = 'localhost';
$dbname = 'telds_shop';
$username = 'root';
$password = '';


        try{
                $pdo = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                return $pdo;
        } catch (PDOExpection $e){
            echo "Connection failed: " . $e->getMessage();
        }