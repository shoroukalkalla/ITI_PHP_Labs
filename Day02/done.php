<?php

$fname = $_REQUEST['firstName'];
$lname = $_REQUEST['lastName'];
$address = $_REQUEST['address'];
$country = $_REQUEST['country'];
$email = $_REQUEST['email'];
$skills = $_REQUEST['skills'];
$department = $_REQUEST['department'];

$query = "";
$missingData = false;
foreach ($_REQUEST as $key => $value) {
    if (!empty($value)) {
        if (is_array($value)) {
            foreach ($value as $insideValue)
                $query .= $insideValue . "=" . "active&";
            continue;
        }
        $query .= $key . "=" . $value . "&";
    } else if (empty($value)) {
        $missingData = true;
    }
}

function emailValidation() {
    global $email;
    if (!preg_match("/^[a-zA-Z-' ]*$/", $email)) {
        return true;
    }
    return false;
}

?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<body>

    <?php if ($missingData || !emailValidation()) { ?>
    <div class="back">
        <?php
            if ($missingData) echo "<p>Please fill all fields and try again</p>";
            if (!emailValidation()) {
                echo  "<p>You entered and invalid E-mail</p>";
            } ?>
        <a href='registration.php?<?php echo $query; ?>'>Go Back</a>
    </div>
    <?php
        return;
    } ?>

    <?php

    $customersData = "$fname:$lname:$email:$address" .  PHP_EOL;

    $customerFile = fopen("customer.txt", "a+");
    fwrite($customerFile, $customersData);
    fclose($customerFile);

    header("Location: view.php");
    ?>



</body>

</html>