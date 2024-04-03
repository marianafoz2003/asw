<?php
include "abreconn.php";
session_start();
$email = $_SESSION['email'];



$titulo = htmlspecialchars($_POST['titulo']);
$estado = htmlspecialchars($_POST['estado']);
$tipo = htmlspecialchars($_POST['tipo']);
$tamanho = htmlspecialchars($_POST['tamanho']);
$categoria = htmlspecialchars($_POST['categoria']);
$marca = htmlspecialchars($_POST['marca']);
$preco = htmlspecialchars($_POST['preco']);
$descricao = htmlspecialchars($_POST['descricao']);
// $vendedor = htmlspecialchars($_POST['vendedor']);
$dataRegisto = date('Y-m-d');

if (isset($_FILES["arquivo"])) {
    $arquivo = $_FILES['arquivo'];
    
    $pasta = "uploads/";
    $nomeArquivo = $arquivo['name'];
    $novoNome = uniqid();
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    // print_r($pasta.$novoNome . "." . $extensao );

    $envia = move_uploaded_file($arquivo["tmp_name"], $pasta.$novoNome . "." . $extensao );

    $path = $pasta.$novoNome . "." . $extensao;
    if($envia){

        $ins = $conn->prepare("INSERT INTO images (filename) VALUES (?)");

        $ins->bind_param("s", $path);
        $ins->execute();

    }
}

$stmt1 = $conn->prepare("SELECT id FROM utilizador WHERE email = ?");
$stmt1->bind_param("s", $email);
if (!$stmt1->execute()) {
echo "Error: " . $stmt->error;
exit();
}
$result = $stmt1->get_result();
$row = $result->fetch_assoc();
$vendedor = $row['id'];


$stmt2 = $conn->prepare("INSERT INTO produto (titulo, estado, tipo, tamanho, categoria, marca, preco, dataRegisto, descricao, vendedor, imagem) 
VALUES (?, ?, ?, (SELECT id FROM tamanho WHERE nome = ?), 
(SELECT id FROM categoria WHERE nome = ?), (SELECT id FROM marca WHERE nome = ?), 
?, ?, ?, ?, ?)");

$stmt2->bind_param("ssssssdssis", $titulo, $estado, $tipo, $tamanho, $categoria, $marca, $preco, $dataRegisto, $descricao, $vendedor, $path);

if (!$stmt2->execute()) {
    echo "Error: " . $stmt2->error;
    exit();
}

$stmt1->close();
$stmt2->close();



echo "<script> window.location = 'processa.php'</script>";

?>



