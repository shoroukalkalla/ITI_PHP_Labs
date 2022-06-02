<html>
    <body>
        <ul>
<?php
    if(isset($_REQUEST['email'])){
        $email=$_REQUEST['email'];
        try{
            $conn = new pdo("mysql:dbname=iti;host=localhost;","root","password");
            $data = $conn->query("select * from instructors where email= '$email'");

            $res = $data->fetch(PDO::FETCH_ASSOC);
                foreach($res as $value){
                    echo "<li>$value</li>";
                }
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

?>
</ul>
</body>
</html>