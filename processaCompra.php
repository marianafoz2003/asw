<?php
include "abreconn.php";
session_start();
$email = $_SESSION['email'];

$id = $_GET['id'];

$stmt1 = $conn->prepare("SELECT id FROM utilizador WHERE email = ?");
$stmt1->bind_param("s", $email);
if (!$stmt1->execute()) {
echo "Error: " . $stmt1->error;
exit();
}
$result = $stmt1->get_result();
$row = $result->fetch_assoc();
$comprador = $row['id'];
$dataVenda = date('Y-m-d');


$stmt2 = $conn->prepare("SELECT * FROM produto WHERE id = ?");
$stmt2->bind_param("i", $id);
if (!$stmt2->execute()) {
echo "Error: " . $stmt2->error;
exit();
}
$result = $stmt2->get_result();
$row = $result->fetch_assoc();
$produto = $row['id'];
$vendedor = $row['vendedor'];

$stmt3 = $conn->prepare("INSERT INTO compra (vendedor, comprador, produto, dataVenda) VALUES (?, ?, ?, ?)");
$stmt3->bind_param("iiis", $vendedor, $comprador, $produto, $dataVenda);
if (!$stmt3->execute()) {
echo "Error: " . $stmt3->error;
exit();
}


$stmt1->close();
$stmt2->close();
$stmt3->close();



echo "<script> window.location = 'processa.php'</script>";

?>