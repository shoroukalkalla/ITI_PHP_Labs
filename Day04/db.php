<?php
print_r($_REQUEST);
if(isset($_REQUEST['add'])){
    try{
        //connection
        $conn = new pdo("mysql:dbname=iti;host=localhost;","root","password");
        //query
        $query = $conn->prepare("insert into instructors(firstName, lastName, email, address, password)
        values(?,?,?,?,?)
        ");
        $query->execute([$_REQUEST['fname'],$_REQUEST['lname'],$_REQUEST['email'],$_REQUEST['address'],$_REQUEST['password']]);
        header("Location: view.php");
    }catch(PDOException $e){
        die($e->getMessage());
    }
}
?>