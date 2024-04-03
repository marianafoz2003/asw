<?php
include "abreconn.php";
session_start();
$email = $_SESSION['email'];

$marca = isset($_POST['marca']) ? htmlspecialchars($_POST['marca']) : '0';
$categorias = isset($_POST['categoria']) ? $_POST['categoria'] : [];
$tamanhos = isset($_POST['tamanho']) ? $_POST['tamanho'] : [];

$stmt = $conn->prepare("SELECT id FROM utilizador WHERE email = ?");
$stmt->bind_param("s", $email);
if (!$stmt->execute()) {
	echo "Error: " . $stmt->error;
	exit();
}
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$id = $row['id'];


if ($marca !== '0') {
  $stmt1 = $conn->prepare("UPDATE utilizador SET marca = (SELECT id FROM marca WHERE nome = ?) WHERE id = ?");
  if (!$stmt1) {
    echo "Error: " . $conn->error;
    exit();
  }
  $stmt1->bind_param("si", $marca, $id);
  if (!$stmt1->execute()) {
    echo "Error: " . $stmt1->error;
    exit();
  }
  $stmt1->close();
}


if (isset($_POST['add_categoria'])) {
  $addCategoria = $_POST['add_categoria'];
  $stmt2 = $conn->prepare("INSERT INTO utilizador_categoria (utilizador, categoria) VALUES (?, (SELECT id FROM categoria WHERE nome = ?))");
  if (!$stmt2) {
    echo "Error: " . $conn->error;
    exit();
  }
  $stmt2->bind_param("is", $id, $addCategoria);
  if (!$stmt2->execute()) {
    echo "Error: " . $stmt2->error;
    exit();
  }
  $stmt2->close();
}

if (isset($_POST['remove_categoria'])) {
  $removeCategoria = $_POST['remove_categoria'];
  $stmt3 = $conn->prepare("DELETE FROM utilizador_categoria WHERE utilizador = ? AND categoria = (SELECT id FROM categoria WHERE nome = ?)");
  if (!$stmt3) {
    echo "Error: " . $conn->error;
    exit();
  }
  $stmt3->bind_param("is", $id, $removeCategoria);
  if (!$stmt3->execute()) {
    echo "Error: " . $stmt3->error;
    exit();
  }
  $stmt3->close();
}


if (isset($_POST['add_tamanho'])) {
  $addTamanho = $_POST['add_tamanho'];
  $stmt4 = $conn->prepare("INSERT INTO utilizador_tamanho (utilizador, tamanho) VALUES (?, (SELECT id FROM tamanho WHERE nome = ?))");
  if (!$stmt4) {
    echo "Error: " . $conn->error;
    exit();
  }
  $stmt4->bind_param("is", $id, $addTamanho);
  if (!$stmt4->execute()) {
    echo "Error: " . $stmt4->error;
    exit();
  }
  $stmt4->close();
}

if (isset($_POST['remove_tamanho'])) {
  $removeTamanho = $_POST['remove_tamanho'];
  $stmt5 = $conn->prepare("DELETE FROM utilizador_tamanho WHERE utilizador = ? AND tamanho = (SELECT id FROM tamanho WHERE nome = ?)");
  if (!$stmt5) {
    echo "Error: " . $conn->error;
    exit();
  }
  $stmt5->bind_param("is", $id, $removeTamanho);
  if (!$stmt5->execute()) {
    echo "Error: " . $stmt5->error;
    exit();
  }
  $stmt5->close();
}


$conn->close();


header("Location: pref.php");
exit();

