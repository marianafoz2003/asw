<?php
include "abreconn.php";
session_start();
$email = $_SESSION['email'];


$id = htmlspecialchars($_POST['id']);
$vend = htmlspecialchars($_POST['vend']);
$msg = htmlspecialchars($_POST['msg']);

$sql = "SELECT id FROM utilizador WHERE email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$comp = $row['id'];

// ut1 = quem envia
// ut2 = quem recebe


$sql = "INSERT INTO chat (produto, utilizador1, utilizador2, mensagem) VALUES ('$id', '$comp', '$vend', '$msg')";
$result = $conn->query($sql);

header("Location: chat1.php?id=$id&vend=$vend");


?>