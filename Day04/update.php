<?php
if(isset($_REQUEST['Update'])){
    $email=$_REQUEST['email'];
    try{
        $conn = new pdo("mysql:dbname=iti;host=localhost;","root","password");
        $data = $conn->prepare("update instructors set firstName=?,lastName=?,email=?,address=?,password=?");
        $data->execute([$_REQUEST['fname'],$_REQUEST['lname'],$_REQUEST['email'],$_REQUEST['address'],$_REQUEST['password']]);
        header("Location: view.php");
            
    }catch(PDOException $e){
        die($e->getMessage());
    }
}


?>