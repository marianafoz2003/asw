<?php
session_start();
include "abreconn.php";

$ok = isset($_SESSION['email']);
if($ok){
    $nome = $_SESSION['nome'];
}

// if (isset($_FILES["arquivo"])) {
//     $arquivo = $_FILES['arquivo'];
    
//     $pasta = "uploads/";
//     $nomeArquivo = $arquivo['name'];
//     $novoNome = uniqid();
//     $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

//     print_r($pasta.$novoNome . "." . $extensao );

//     $envia = move_uploaded_file($arquivo["tmp_name"], $pasta.$novoNome . "." . $extensao );

//     $path = $pasta.$novoNome . "." . $extensao;
//     if($envia){

//         $ins = $conn->prepare("INSERT INTO images (filename) VALUES (?)");

//         $ins->bind_param("s", $path);
//         $ins->execute();



//     }
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
</head>

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

                    echo $userAuth
                    ?>




            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>

    <main class="my-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-4">
                        <h2 class="text-center mb-4">Registo de Produto</h2>
                        <form method="POST" action="processaProd.php" enctype="multipart/form-data">
                            <!-- action="processaProd.php" -->

                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado" class="form-control">
                                    <option value="" disabled selected>--selecione--</option>
                                    <option value="novo com etiqueta">Novo com etiqueta</option>
                                    <option value="novo sem etiqueta">Novo sem etiqueta</option>
                                    <option value="muito bom">Muito Bom</option>
                                    <option value="bom">Bom</option>
                                    <option value="satisfatorio">Satisfatório</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="" disabled selected>--selecione--</option>
                                    <option value="tshirt">T-Shirt</option>
                                    <option value="calcas">Calças</option>
                                    <option value="blusa">Blusa</option>
                                    <option value="camisola">Camisola</option>
                                    <option value="chapeu">Chapéu</option>
                                    <option value="casaco">Casaco</option>
                                    <option value="vestido">Vestido</option>
                                    <option value="saia">Saia</option>
                                    <option value="calcoes">Calções</option>
                                    <option value="acessorios">Acessórios</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tamanho">Tamanho:</label>
                                <select id="tamanho" name="tamanho" class="form-control">
                                    <option value="" disabled selected>--selecione--</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoria:</label>
                                <select id="categoria" name="categoria" class="form-control">
                                    <option value="" disabled selected>--selecione--</option>
                                    <option value="mulher">Mulher</option>
                                    <option value="homem">Homem</option>
                                    <option value="crianca">Criança</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="marca">Marca:</label>
                                <select id="marca" name="marca" class="form-control">
                                    <option value="" disabled selected>--selecione--</option>
                                    <option value="bershka">Bershka</option>
                                    <option value="tiffosi">Tiffosi</option>
                                    <option value="pullBear">Pull&Bear</option>
                                    <option value="levis">Levi's</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="preco">Preço:</label>
                                <input type="float" name="preco" id="preco" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <input type="text" name="descricao" id="descricao" class="form-control" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="vendedor">Vendedor:</label>
                                <input type="text" name="vendedor" id="vendedor" class="form-control" required>
                            </div> -->

                            <div class="form-group">
                                <label for="imagem">Imagem:</label>
                                <input type="file" name="arquivo" id="imagem" class="form-control-file">
                            </div>

                            <button type="submit" class="btn-block buy-btn">Submeter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


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