<?php

include "abreconn.php";

$email = $_POST["email"];
$sql = "SELECT id, senha, nome, email FROM utilizador WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();



if($result->num_rows != 0){

  $row = $result->fetch_assoc();
  //print_r($row);
  $id = $row['id'];
  $pass = $row['senha'];
  $nome = $row['nome'];
  $email = $row['email'];
  //var_dump($pass);
  //print_r($_POST["pass"]);

  if (password_verify($_POST["pass"],$pass)) {
    //print_r('aqui');
    session_start();
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    $link = "'index.php'";
    echo "<script>window.location = $link</script>";
  }else{
    //print_r('aqui 2');
    $link = "'login.php'";
    echo "<script>alert('Palavra-passe incorreta.')</script>";
    echo "<script>window.location = $link</script>";
    
  }
}else{
  $link = "'login.php'";
  echo "<script>alert('E-mail não registado.')</script>";
  echo "<script>window.location = $link</script>";
}
$conn->close();
?>
