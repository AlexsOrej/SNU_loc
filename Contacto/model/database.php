<?php
class Database
{
    public static function StartUp()
    {
        // $pdo = new PDO('mysql:host=localhost;dbname=document_principalcambios;charset=utf8', 'document_calidad', 'calidad2017');
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        // return $pdo;
        try {
            $host = 'localhost';
            $dbname = 'normalizacion_snu';
            $username = 'normalizacion_snu';
            $password = '?dXe0dmFlMcG';
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
            echo "Connected to $dbname at $host successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the database $dbname :" . $pe->getMessage());
        }
    }
}
