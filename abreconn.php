<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $servername = "appserver-01.alunos.di.fc.ul.pt";
	$username = "asw20";
	$password = "grupovinte";
	$dbname = "asw20";
	//Cria a ligação à BD
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Verifica a ligação à BD
	if ($conn->connect_error) {
 		die("Connection failed: " . $conn->connect_error);
	}
  
?>