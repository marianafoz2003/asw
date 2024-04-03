<?php
include "abreconn.php";
session_start();
$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT COUNT(*) AS size FROM produto");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$size = $row['size'];


echo $size;
?>

