<?php
$fname = $_REQUEST['firstName'] ?? "";
$lname = $_REQUEST['lastName'] ?? "";
$address = $_REQUEST['address'] ?? "";
$email = $_REQUEST['email'] ?? "";
$department = $_REQUEST['department'] ?? "";
$code = $_REQUEST['code'] ?? "";
$skills = $_REQUEST['skills'] ?? "";
$gender = $_REQUEST['gender'] ?? "";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="POST" action="Done.php">
        <label>First Name: </label>
        <input type="text" name="firstName" value="<?= $fname ?>" />
        </br></br>
        <label>Last Name: </label>
        <input type="text" name="lastName" value="<?= $lname ?>" /> </br></br>
        <label>Address</label>
        <textarea name="address"><?= $address ?></textarea> </br></br>
        <label>Country</label>
        <select name="country">
            <option value="Egypt" selected>Egypt</option>
            <option value="Egypt">USA</option>
            <option value="Egypt">UK</option>
            <option value="Egypt">German</option>
        </select> </br></br>
        <label>Gender</label>
        <input type="radio" name="gender" value="Male" checked /> Male
        <input type="radio" name="gender" value="Female" <?= $gender == "Female" ? "checked" : "" ?> /> Female
        </br></br>
        <label>Skills</label>
        <input type="checkbox" name="skills[]" value="PHP" <?= isset($_REQUEST['PHP']) ? "checked" : "" ?>>PHP
        <input type="checkbox" name="skills[]" value="J2SE" <?= isset($_REQUEST['J2SE']) ? "checked" : "" ?>>J2SE
        <input type="checkbox" name="skills[]" value="MySQL" <?= isset($_REQUEST['MySQL']) ? "checked" : "" ?>>MySQL
        <input type="checkbox" name="skills[]" value="PostgreSQL"
            <?= isset($_REQUEST['PostgreSQL']) ? "checked" : "" ?>>PostgreSQL <br><br>
        <label>Email</label>
        <input type="text" name="email" value="<?= $email ?>" /> <br><br>
        <label>Password</label>
        <input type="password" name="password" /></br></br>
        <label>Department</label>
        <input type="text" name="department" value="<?= $department ?>" /> </br></br>
        <span>Please insert the code in the blow box</span><br>
        <span>Sh68S0</span> <br>
        <input type="text" name="code" value="<?= $code ?>" /> <br><br>
        <input type="submit" name="submit" />
        <button><a href="registration.php">Reset</a></button>
    </form>
</body>

</html>