<?php
session_start();
$_SESSION["email"]=$_POST['email'];
$conn = mysqli_connect("localhost", "root", "", "alumni") or die("Connection Error: " . mysqli_error($conn));

if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT * from admin WHERE email='" . $_SESSION["email"] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["pwd"]) {
        mysqli_query($conn, "UPDATE admin set pwd='" . $_POST["newPassword"] . "' WHERE email='" . $_SESSION["email"] . "'");
        $_SESSION['message'] = "Password Changed successfully!";
        header('Location: ./adminIndex.php');
    } else {
    	$message="Current password entered is incorrect. Try again!";
    	echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location: ./adminIndex.php');
    }
	exit();
}
?>