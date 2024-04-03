<?php
include "abreconn.php";

$email = htmlspecialchars($_POST['email']);

// Check if email already exists in database
$stmt_check = $conn->prepare("SELECT id FROM utilizador WHERE email = ?");
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
  // If email already exists, show alert and redirect back to form
  echo "<script>alert('E-mail já registado. Tente novamente com outro e-mail.')</script>";
  echo "<script>window.location = 'register.php'</script>";
  exit();
}

// Continue with inserting new record if email does not exist in database
$nome = htmlspecialchars($_POST['nome']);
$dataNasc = htmlspecialchars($_POST['dataNasc']);
$genero = htmlspecialchars($_POST['genero']);
$telefone = htmlspecialchars($_POST['telefone']);
$morada = htmlspecialchars($_POST['morada']);
$localidade = htmlspecialchars($_POST['localidade']);
$codigo_postal = htmlspecialchars($_POST['codigo_postal']);
$senha = password_hash(htmlspecialchars($_POST['senha']), PASSWORD_DEFAULT);
$marca = htmlspecialchars($_POST['marca']);
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : array();
$tamanhos = isset($_POST['tamanho']) ? $_POST['tamanho'] : array();

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Email inválido. Insira um email válido no formato username@domain.";
  exit();
}

if (strlen($senha) < 8) {
  echo "Senha inválida. Insira uma senha com no mínimo 8 caracteres.";
  exit();
}

$stmt = $conn->prepare("INSERT INTO utilizador (nome, dataNasc, genero, telefone, morada, localidade, codigo_postal, email, senha, marca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, (SELECT id FROM marca WHERE nome = ?))");

if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("sssissssss", $nome, $dataNasc, $genero, $telefone, $morada, $localidade, $codigo_postal, $email, $senha, $marca);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
    exit();
}

$stmt->close();

// Inserting selected categorias
if (!empty($categoria)) {
  foreach ($categoria as $cat) {
    $stmt2 = $conn->prepare("INSERT INTO utilizador_categoria (utilizador, categoria) VALUES ((SELECT id FROM utilizador WHERE telefone = ?), (SELECT id FROM categoria WHERE nome = ?))");
    if (!$stmt2) {
        echo "Error: " . $conn->error;
        exit();
    }
    $stmt2->bind_param("is", $telefone, $cat);
    if (!$stmt2->execute()) {
        echo "Error: " . $stmt2->error;
        exit();
    }
    $stmt2->close();
  }
}

// Inserting selected tamanhos
if (!empty($tamanhos)) {
  foreach ($tamanhos as $tam) {
    $stmt3 = $conn->prepare("INSERT INTO utilizador_tamanho (utilizador, tamanho) VALUES ((SELECT id FROM utilizador WHERE telefone = ?), (SELECT id FROM tamanho WHERE nome = ?))");
    if (!$stmt3) {
        echo "Error: " . $conn->error;
        exit();
    }
    $stmt3->bind_param("is", $telefone, $tam);
    if (!$stmt3->execute()) {
        echo "Error: " . $stmt3->error;
        exit();
    }
    $stmt3->close();
  }
}

// Redirect to a success page after successful registration
header("Location: processa.php");
exit();
?>


