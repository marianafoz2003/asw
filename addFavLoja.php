<?php
include "abreconn.php";

session_start();

$email = $_SESSION['email'];
$idUtilizador = $_SESSION['id'];



if(isset($_GET['fav'])){
    $produtoId = $_GET['fav'];
    echo $produtoId;
}

$sql = "SELECT * FROM favoritos WHERE utilizador = $idUtilizador AND produto = $produtoId";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<script> window.location = 'index.php'</script>";
    exit();
}else{
    $stmt2 = $conn->prepare("INSERT INTO favoritos (utilizador, produto) VALUES (?,?)");
$stmt2->bind_param('ii', $idUtilizador, $produtoId);

if (!$stmt2->execute()) {
    echo "Error: " . $stmt2->error;
    exit();
}

$stmt2->close();

echo "<script> window.location = 'index.php'</script>";
}


?>