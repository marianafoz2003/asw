<?php
session_start();
include "abreconn.php";


$ok = isset($_SESSION['email']);


if($ok){
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
}

// if($ok){
//     $email = $_SESSION['email'];
//     $nome = "SELECT nome FROM utilizador WHERE email = '" . $email . "'";

//     $result =  $conn->query($nome);
//     print_r($result);

// }

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <?php
    if($ok){
        echo '<script src="notif.js"></script>';
    }
    ?>


</head>
<style>
.product .btn1 {
    color: black;
    background-color: #fff;
    padding: 0.5rem 1rem;
    transform: translateY(20px);
    opacity: 0;
    transition: 0.3s all;
}

.product:hover .btn1 {
    transform: translateY(0);
    opacity: 1;
}
</style>

<body>

    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <a href="index.php">
                <img src="img/logo1.png" alt="" style="width: 11em;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span><i id="bar" class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Loja</a>
                    </li>

                    <?php
                    $noAuth =
                    '<li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sessão</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="register.php">Registar</a>
                      </li>';

                    $authPlus =
                        '   </a>
                        <li class="nav-item">
                        <a class="nav-link" href="chat.php">Mensagens</a>
                        </li>
                        </li> 
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Fechar Sessão</a></li>';
                    
                    $authPerfil1 = '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">';
                    
                    $authPerfil2 = '</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="regProduto.php">Adicionar Produtos</a></li>
                        <li><a class="dropdown-item" href="pref.php">Preferências</a></li>
                        <li><a class="dropdown-item" href="#">Atualizar Dados</a></li>
                    </ul>
                </li>';

                    
                    if($ok){
                        $userAuth = $authPerfil1 . $nome . $authPerfil2.$authPlus . '<li><i onclick=window.location.href="fav.php"; class="fal fa-heart"></i> </li>';

                    } else {
                        $userAuth = $noAuth;
                    }

                    echo $userAuth;
                    ?>




            </div>
        </div>
    </nav>

    <section id="home">
        <div class="container">
            <h5>Melhor Preço</h5>
            <h1><span>Compra Em</span> Segunda Mão</h1>
            <p>Aqui encontras roupa de qualidade aos preços<br> mais baixos que já viste.</p>
            <button onclick="window.location.href='shop.php'">Comprar Agora</button>
        </div>
    </section>


    <section id="clothes" class="my-5">
        <?php 

  if ($ok) {
	    echo '<div class="container text-center mt-5 py-5">
		    <h3>Novos Produtos das suas preferências</h3>
		    <hr class="mx-auto">
		    <p></p>
		    <h4>Da marca preferida:</h4>
		  </div>
		  <div class="row mx-auto container">';
		    
	    $stmt1 = $conn->prepare("SELECT id, marca FROM utilizador WHERE email = ?");
	    $stmt1->bind_param("s", $email);
	    if (!$stmt1->execute()) {
	      echo "Error: " . $stmt1->error;
	      exit();
	    }
	    $result1 = $stmt1->get_result();
	    $row1 = $result1->fetch_assoc();
	    $idUtilizador = $row1['id'];
	    $marcaUtilizador = $row1['marca'];

	    $stmt2 = $conn->prepare("SELECT * FROM produto WHERE marca = ? AND id NOT IN (SELECT produto FROM compra) AND vendedor != ?");
	    $stmt2->bind_param("si", $marcaUtilizador, $idUtilizador);
	    if (!$stmt2->execute()) {
	      echo "Error: " . $stmt2->error;
	      exit();
	    }
	    $result2 = $stmt2->get_result();
	    if ($result2->num_rows > 0) {
	      while ($produto = $result2->fetch_assoc()) {
	?>

        <div class="product col-lg-3 col-md-4 col-12 text-center">
            <img class="mb-3 img-fluid" src="<?php echo $produto['imagem']; ?>" alt="">
            <h5 class="p-name"><?php echo $produto['titulo']; ?></h5>
            <h4 class="p-price"><?php echo $produto['preco']; print(' €');?></h4>
            <button class="buy-btn"
                onclick="window.location.href='sproduct.php?id=<?php echo urlencode($produto['id']); ?>';">Comprar</button>
            <button class="btn1" onClick="addFav(<?php echo $produto['id'];?>)" value="<?php echo $produto['id']?>">
                <i class="fas fa-heart"></i>
            </button>

        </div>


        <?php 
                }
            
            }else{
                echo '<p>De momento não temos produtos da tua marca preferida :(</p>';
            }

        echo '<div class="container text-center mt-5 py-5">
            <h4>Do seu tamanho:</h4>
            </div>
            <div class="row mx-auto container">';

	$stmt3 = $conn->prepare("SELECT * FROM utilizador_tamanho WHERE utilizador = ?");
	$stmt3->bind_param('i', $idUtilizador);
	if (!$stmt3->execute()) {
	    echo "Error: " . $stmt->error;
	    exit();
	}
	$result3 = $stmt3->get_result();
	$row3 = $result3->fetch_assoc();
	$tamanho = $row3['tamanho'];

	$stmt4 = $conn->prepare("SELECT * FROM produto WHERE tamanho = ? AND id NOT IN (SELECT produto FROM compra) AND vendedor != ?");
	$stmt4->bind_param("si", $tamanho, $idUtilizador);
	if (!$stmt4->execute()) {
	    echo "Error: " . $stmt4->error;
	    exit();
	}
	$result4 = $stmt4->get_result();
	if ($result4->num_rows > 0) {
	    while ($produto = $result4->fetch_assoc()) {
		?>
        <div class="product col-lg-3 col-md-4 col-12 text-center">
            <img class="mb-3 img-fluid" src="<?php echo $produto['imagem']; ?>" alt="">
            <h5 class="p-name"><?php echo $produto['titulo']; ?></h5>
            <h4 class="p-price"><?php echo $produto['preco']; print(' €');?></h4>
            <button class="buy-btn"
                onclick="window.location.href='sproduct.php?id=<?php echo urlencode($produto['id']); ?>';">Comprar</button>
            <button class="btn1" onClick="addFav(<?php echo $produto['id'];?>)" value="<?php echo $produto['id']?>">
                <i class="fas fa-heart"></i>
            </button>

        </div>
        <?php 
	    }
	} else {
	    echo '<p>De momento não temos produtos do teu tamanho preferido :(</p>';
	}


            	echo '<div class="container text-center mt-5 py-5">
        		<h4>Da sua categoria:</h4>
		      </div>
		      <div class="row mx-auto container">';

		$stmt5 = $conn->prepare("SELECT * FROM utilizador_categoria WHERE utilizador = ?");
		$stmt5->bind_param('i', $idUtilizador);
		if (!$stmt5->execute()) {
		  echo "Error: " . $stmt5->error;
		  exit();
		}
		$result5 = $stmt5->get_result();
		$row5 = $result5->fetch_assoc();
		$categoria = $row5['categoria'];

		$stmt6 = $conn->prepare("SELECT * FROM produto WHERE categoria = ? AND id NOT IN (SELECT produto FROM compra) AND vendedor != ?");
		$stmt6->bind_param("si", $categoria, $idUtilizador);
		if (!$stmt6->execute()) {
		  echo "Error: " . $stmt6->error;
		  exit();
		}
		$result6 = $stmt6->get_result();
		if ($result6->num_rows > 0) {
		  while ($produto = $result6->fetch_assoc()) {
		    ?>
        <div class="product col-lg-3 col-md-4 col-12 text-center">
            <img class="mb-3 img-fluid" src="<?php echo $produto['imagem']; ?>" alt="">
            <h5 class="p-name"><?php echo $produto['titulo']; ?></h5>
            <h4 class="p-price"><?php echo $produto['preco']; print(' €');?></h4>
            <button class="buy-btn"
                onclick="window.location.href='sproduct.php?id=<?php echo urlencode($produto['id']); ?>';">Comprar</button>
            <button class="btn1" onClick="addFav(<?php echo $produto['id'];?>)" value="<?php echo $produto['id']?>">
                <i class="fas fa-heart"></i>
            </button>
        </div>
        <?php 
		  }
		} else {
		  echo '<p>De momento não temos produtos na sua categoria preferida :(</p>';
		}



            echo '</div></div>' ;   


        } else {
            echo '<div class="container text-center mt-5 py-5">
            <h3>Veja <a href="shop.php">aqui</a> os nossos produtos. Para uma pesquisa personalizada faça <a href="login.php">Login</a> ou <a href="register.php">Registe-se</a></h3>
            <hr class="mx-auto">
            <p></p>
            </div>
            <div class="row mx-auto container">'
            ;
            $sql_query= $conn->query("SELECT * FROM produto");
            $i = 0;
            if($sql_query->num_rows > 0 ){
                while($produto = $sql_query->fetch_assoc()){
                    if($i < 4){
        ?>


        <div onclick="window.location.href='sproduct.php?id=<?php echo urlencode($produto['id']); ?>';"
            class="product col-lg-3 col-md-4 col-12 text-center">
            <!-- <i class="fas fa-heart"></i> -->
            <img class="mb-3 img-fluid" src="<?php echo $produto['imagem']; ?>" alt="">
            <h5 class="p-name"><?php echo $produto['titulo']; ?></h5>
            <h4 class="p-price"><?php echo $produto['preco']; print(' €');?></h4>
            <button class="buy-btn">Comprar</button>
        </div>


        <?php        
                    $i+=1;
                    }
                }
            echo '</div>' ;
            }

        }

        ?>



    </section>


    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <img src="img/logo2.png" style="width: 14em;" alt="">
                <p class="pt-3">Comprem em segunda mão. Vende as peças de roupa que já não usas!!!</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h5 class="pb-2">Categorias</h5>
                <ul class="text-uppercase list-unstyled">
                    <li>
                        <p>MULHER</p>
                    </li>
                    <li>
                        <p>HOMEM</p>
                    </li>
                    <li>
                        <p>CRIANÇA</p>
                    </li>
                    <li>
                        <p>OUTRO</p>
                    </li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h5 class="pb-2">Contacta-nos</h5>
                <div>
                    <h6 class="text-uppercase">Morada</h6>
                    <p>Faculdade de Ciências da Universidade de Lisboa</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Números</h6>
                    <p>54950 - 58649 - 58955</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>grupo20@alunos.fc.ul.pt</p>
                </div>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/1.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/2.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/3.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/4.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/5.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="copyright mt-5">
            <div class="row container mx-auto">

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <img src="img/payment.png" alt="">
                </div>
                <div class="col-lg-4 col-md-6 col-12 text-nowrap mb-2">
                    <p>FCUL2HandCloth eCommerce © 2023. All Rights Reserved</p>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    function addFav(productId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // Handle the response from the server if needed
                console.log(this.responseText);
                // Update the UI or perform any other actions
            }
        };
        xhttp.open("POST", "addFav.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("fav=" + productId);
    }
    </script>



</body>

</html>
