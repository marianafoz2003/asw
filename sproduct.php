<?php
session_start();
include "abreconn.php";

$ok = isset($_SESSION['email']);
if($ok){
    $nome = $_SESSION['nome'];
}

// if($ok){
//     $email = $_SESSION['email'];
//     $nome = "SELECT nome FROM utilizador WHERE email = '" . $email . "'";

//     $result =  $conn->query($nome);
//     print_r($result);

// }

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
.product-details h4 {
    font-weight: bold;
}

.product-details h4 span {

    margin: 0;
    font-weight: normal;
}

.product-details {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    grid-gap: 10px;
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
                        // <li><i class="fal fa-bell"></i> </li>

                    } else {
                        $userAuth = $noAuth;
                    }

                    echo $userAuth
                    ?>




            </div>
        </div>
    </nav>
    <?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM produto WHERE id = $id";
    $result = $conn->query($sql);
    $produto = $result->fetch_assoc();
    $vendedor = $produto['vendedor'];
    $marca = $produto['marca'];
    $categoria = $produto['categoria'];
    $tamanho = $produto['tamanho'];

    $sql2 = "SELECT * FROM utilizador WHERE id = '$vendedor'";
    $result2 = $conn->query($sql2);
    $vend = $result2->fetch_assoc();

    $sql3 = "SELECT * FROM marca WHERE id = '$marca'";
    $result3 = $conn->query($sql3);
    $marc = $result3->fetch_assoc();

    $sql4 = "SELECT * FROM categoria WHERE id = '$categoria'";
    $result4 = $conn->query($sql4);
    $cat = $result4->fetch_assoc();


    $sql5 = "SELECT * FROM tamanho WHERE id = '$tamanho'";
    $result5 = $conn->query($sql5);
    $tam = $result5->fetch_assoc();

?>
    <section class="container sproduct my-5 pt-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-12 col-12">
                <img class="img-fluid w-100 pb-1" src="<?php echo $produto['imagem']; ?>" id="MainImg" alt="">
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <h3 class="py-4"><?php echo $produto['titulo']; ?></h3>
                <div class="product-details">

                    <h4>Estado: <span><?php echo $produto['estado']; ?></span></h4>

                    <h4>Tipo: <span> <?php echo $produto['tipo']; ?> </span></h4>

                    <h4>Marca: <span><?php echo $marc['nome']; ?></span></h4>

                    <h4>Tamanho: <span><?php echo $tam['nome']; ?></span></h4>

                    <h4>Categoria: <span><?php echo $cat['nome']; ?></span></h4>

                    <h4>Descrição: <span><?php echo $produto['descricao']; ?></span></h4>

                    <h4>Vendedor: <span><?php echo $vend['nome']; ?></span></h4>
                </div>
                <br>
                <h2><span><?php echo $produto['preco']; ?></span> €</h2>
                <button class="buy-btn" <?php
                if($ok){
                    echo 'onclick="window.location.href=\'cart.php?id=' . urlencode($id) . '\';"';
                } else {
                    echo 'onclick="window.location.href=\'login.php\';"'; 
                }
                ?>>Comprar</button>
                <button class="buy-btn" <?php
                if($ok){
                    echo 'onclick="window.location.href=\'chat1.php?id=' . urlencode($id) . '&vend=' . urlencode($vend['id']) . '\';"';

                } else {
                    echo 'onclick="window.location.href=\'login.php\';"'; 
                }
                ?>>Mandar Mensagem</button>

            </div>
    </section>
    <!-- 
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Itens do mesmo vendedor</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img class="img-fluid mb-3" src="img/featured/1.jpg" alt="">
                <h5 class="p-name">Roupa</h5>
                <h4 class="p-price">15.00€</h4>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img class="img-fluid mb-3" src="img/featured/2.jpg" alt="">
                <h5 class="p-name">Roupa</h5>
                <h4 class="p-price">15.00€</h4>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img class="img-fluid mb-3" src="img/featured/3.jpg" alt="">
                <h5 class="p-name">Roupa</h5>
                <h4 class="p-price">15.00€</h4>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img class="img-fluid mb-3" src="img/featured/4.jpg" alt="">
                <h5 class="p-name">Roupa</h5>
                <h4 class="p-price">15.00€</h4>
                <button class="buy-btn">Comprar</button>
            </div>
        </div>
    </section> -->

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

    <script>
    var MainImg = document.getElementById('MainImg');
    var smallimg = document.getElementsByClassName('small-img');

    smallimg[0].onclick = function() {
        MainImg.src = smallimg[0].src;
    }
    smallimg[1].onclick = function() {
        MainImg.src = smallimg[1].src;
    }
    smallimg[2].onclick = function() {
        MainImg.src = smallimg[2].src;
    }
    smallimg[3].onclick = function() {
        MainImg.src = smallimg[3].src;
    }
    </script>
</body>

</html>