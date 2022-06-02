<table border=2>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Password</th>
    </tr>


<?php
    //connection
    try{
        $pdo = new pdo("mysql:dbname=iti;host=localhost;","root","password");
        $data=$pdo->query("select * from instructors");
        while($row=$data->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
            foreach($row  as $value)
            {
                echo "<td>$value</td>";
            }
            echo "<td><a href='show.php?email={$row['email']}'>Show</a></td>";
            echo "<td><a href='edit.php?email={$row['email']}'>Edit</a></td>";
            echo "<td><a href='delete.php?email={$row['email']}'>Delete</a></td>";
            echo "</tr>";

        }

    }catch(PDOException $e){
        die($e->getMessage());
    }

?>

</table>