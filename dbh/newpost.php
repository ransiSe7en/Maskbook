<?php
session_start();
if (!isset($_SESSION['user'])) {
        header('Location:../index.php');
}

if (!isset($_POST['desc'])) {
        header('Location:../home.php');
        die();
}


//echo ($email . "<br/>" . $description . "<br/>");

include('dbdata.php');
$con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

$email = $_SESSION['user'];
$description = $con->real_escape_string($_POST['desc']);
//$image = addslashes(file_get_contents($_FILES['Image']));
//$image = $_FILES['Image'];
$imgContent = addslashes(file_get_contents($image)); 




$sql = "INSERT INTO masks(description,email,image) VALUES ('$description','$email','$imgContent')";
$result = $con->query($sql);
if ($result == TRUE) {
        header("Location:../home.php");
} else {
        header("Location:../home.php?failed");
}
$con->close();
?>