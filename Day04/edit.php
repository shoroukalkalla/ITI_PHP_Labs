<?php
     if(isset($_REQUEST['email'])){
        $email=$_REQUEST['email'];
        try{
            $conn = new pdo("mysql:dbname=iti;host=localhost;","root","password");
            $data = $conn->query("select * from instructors where email= '$email'");

            $res = $data->fetch(PDO::FETCH_ASSOC);
                
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

?>

<html>


<form action="update.php">
    First Name:<input type="text" placeholder="FirstName" name="fname" value=<?= $res['firstName']; ?> > <br>
    Last Name:<input type="text" placeholder="LastName" name="lname" value=<?= $res['lastName']; ?>><br>
    Email:<input type="text" placeholder="Email" name="email" value=<?= $res['email']; ?>><br>
    Address:<input type="text" placeholder="Address" name="address" value=<?= $res['address']; ?>><br>
    Password:<input type="password" placeholder="Password" name="password" value=<?= $res['password']; ?>><br>
        <input type="submit" value="update" name="Update">
    </form>

</html>