<?php
$isv = isset($_GET["v"]);
$isc = isset($_GET["c"]);
$isp = isset($_GET["p"]);
if($isv and $isc and $isp){
    require_once "lib/nusoap.php";
    $v = $_GET['v'];
    $c = $_GET['c'];
    $p = $_GET['p'];
    $client = new nusoap_client(
        'http://appserver-01.alunos.di.fc.ul.pt/~asw20/projeto/pags/soapServer.php'
    );
    $error = $client->getError();
    $result = $client->call('CompraProduto', array('IDVendedor' => $v,'IDComprador' => $c,'IDProduto' => $p));	//handle errors

    echo "<h2>Pedido</h2>";
    echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
    echo "<h2>Resposta</h2>";
    echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";

    if ($client->fault)
    {   //check faults
    }
    else {    $error = $client->getError();		 //handle errors
            echo "<h2>$result</h2>";
    }
};
?>

<form action="soapClient.php"  method="get">
    <input name="v" type="text" placeholder="input vendedor">
    <input name="c" type="text" placeholder="input comprador">
    <input name="p" type="text" placeholder="input produto">
    <button name="submit" type="submit">send</button>
</form>