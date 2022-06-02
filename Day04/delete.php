<?php
    if(isset($_REQUEST['email'])){
        try{
            $pdo = new pdo("mysql:dbname=iti;host=localhost;","root","password");
            echo "delete from instructors where email='{$_REQUEST['email']}'";
            $pdo->query("delete from instructors where email='{$_REQUEST['email']}'");
        }catch(PDOException $e){
            die($e->getMessage());
        }   
    }

    header("Location: view.php");

?>