<?php
require_once "lib/nusoap.php";

function CompraProduto($IDVendedor,$IDComprador,$IDProduto)
{
	$dbhost="appserver-01.alunos.di.fc.ul.pt";
	$dbuser="asw20";	$dbpass="grupovinte";	$dbname="asw20";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}

    $IDVendedor = intval($IDVendedor);
    $IDComprador = intval($IDComprador);
    $IDProduto = intval($IDProduto);

    //Verificação se produto já está na tabela da compra
    $sql = "SELECT COUNT(*) FROM compra WHERE produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $IDProduto);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = 0;
    if ($row = $result->fetch_row()) {
        $count = $row[0];
    }

    //Verificar o vendedor
    $sql2 = "SELECT vendedor FROM produto WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $IDProduto);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
    $vendedor = $row2['vendedor'];


    //Verifica o comprador
    $sql4 = "SELECT * FROM utilizador WHERE id = ?";
    $stmt4 = $conn->prepare($sql4);
    $stmt4 ->bind_param("i",$IDComprador);
    $stmt4->execute();
    $result4 = $stmt4->get_result();
    $row4 = $result4->fetch_assoc();



    $dataVenda = date('Y-m-d');

	if($count == 0){
        if ($row4){
            if ($vendedor == $IDVendedor) {
                $stmt3 = $conn->prepare("INSERT INTO compra (vendedor, comprador, produto, dataVenda) VALUES (?, ?, ?, ?)");
                $stmt3->bind_param("iiis", $IDVendedor, $IDComprador, $IDProduto, $dataVenda);
                $stmt3->execute();

                return("Aceite");
            } else {
                return("Não Aceite. Produto não pertence a esse vendedor");
            }
        } else{
            return("Não Aceite. Comprador não existe");
        }
        
    }else{
        return ("Não Aceite.Produto já foi vendido");
    }
	
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("CompraProduto", // nome metodo
array('IDVendedor' => 'xsd:string','IDComprador' => 'xsd:string','IDProduto' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#CompraProduto', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>


