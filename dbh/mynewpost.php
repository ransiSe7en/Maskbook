<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

if (!isset($_POST['desc'])) {
    header('Location:../myposts.php');
    die();
}

//echo ($email . "<br/>" . $description . "<br/>");

include('dbdata.php');
$con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

$email = $_SESSION['user'];
$description = $con->real_escape_string($_POST['desc']);

$sql = "INSERT INTO masks(description,email) VALUES ('$description','$email')";
$result = $con->query($sql);
if ($result == TRUE) {
    header("Location:../myposts.php");
} else {
    header("Location:../myposts.php?failed");
}
$con->close();
?>