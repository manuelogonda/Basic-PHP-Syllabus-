<?php
class Dbconnection{
    private $username = "root";
    private $host = "localhost";
    private $dbname = "myoopdb";
    private $password = "";

    protected function connect(){
        try {
            $pdo = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //return $pdo
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed:" . $e->getMessage());
        }
    }
}