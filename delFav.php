<?php
session_start();
include "abreconn.php";

$ok = isset($_SESSION['email']);
$nome = $_SESSION['nome'];
$id = $_SESSION['id'];

if (isset($_GET['del'])) {
    $produtoId = $_GET['del'];

    $stmt2 = $conn->prepare("DELETE FROM favoritos WHERE id = ?");
    $stmt2->bind_param('i', $produtoId);
    if (!$stmt2->execute()) {
        echo "Error: " . $stmt2->error;
        exit();
    }

    $stmt2->close();

    header("Location: fav.php");
    exit();
}

?>
