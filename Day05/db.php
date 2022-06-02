<?php
    class db {
        private $host = "localhost";
        private $dbname = "iti";
        private $username = "root";
        private $password = "password";
        private $connection = null;

        function __construct(){
            $this->connection = new pdo("mysql:dbname=$this->dbname;host=$this->host;",$this->username, $this->password);
        }

        function getConnection(){
            return $this->connection;
        }

        function delete($table, $condition){
            $this->connection->query("delete from $table where $condition");
        }

        function getData($cols, $table, $condition=1){
            return $this->connection->query("select $cols from $table where $condition");
        }

        function addData($table, $cols, $values, $dataArray){
            $query=$this->connection->prepare("insert into $table($cols)values($values)");
            $query->execute($dataArray);
        }

        function updateData($table, $data, $condition){
            $query=$this->connection->query("update $table set $data where $condition");
        }
    }


?>