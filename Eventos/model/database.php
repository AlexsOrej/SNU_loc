<?php
class Database
{

    public static function Cbdato($cliente){       
    $host = 'localhost';
    $dbname = 'normalizacion_snu';
    $username = 'normalizacion_snu';
    $password = '?dXe0dmFlMcG';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
        try {
            $sql = "SELECT squema FROM squemas WHERE cliente_id = :id";
            $stm = $pdo->prepare($sql);
            $stm->execute(array(':id' => $cliente));
            $result = $stm->fetch(PDO::FETCH_OBJ);
            if (!empty($result)) {
                return $result->squema;
            } else {
                return 'no hay squema';
            }
            

        } catch (PDOException $pe) {
            if ($pe->getCode() == 'HY000') {
                die("An error occurred while executing the query: " . $pe->getMessage());
            } else {
                die("An unexpected error occurred: " . $pe->getMessage());
            }
        }
         

	}



    public static function StartUp($cliente)
{
    $host = 'localhost';
    $dbname = $cliente;
    $username = 'normalizacion_snu';
    $password = '?dXe0dmFlMcG';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
       
        // return "Connected to $dbname at $host successfully.";
        
        return $pdo;
    } catch (PDOException $pe) {
        die("Could not connect to the database $dbname: " . $pe->getMessage());
    }
}

}
