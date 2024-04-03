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
    <title>Registo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
</head>

<body>


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
                        $userAuth = $authPerfil1 . $nome . $authPerfil2.$authPlus;

                    } else {
                        $userAuth = $noAuth;
                    }

                    echo $userAuth
                    ?>





            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                        <h2 class="text-center mb-4">Registo de Utilizador</h2>
                        <form method="POST" action="bdutilizador.php">

                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="dataNasc">Data de Nascimento:</label>
                                <input type="date" name="dataNasc" id="dataNasc" class="form-control" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="genero">Género:</label>
                                <select id="genero" name="genero" class="form-control" required>
                                    <option value="" disabled selected>--selecione--</option>
                                    <option value="outro">Outro</option>
                                    <option value="feminino">Feminino</option>
                                    <option value="masculino">Masculino</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="tel" name="telefone" id="telefone" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="morada">Morada:</label>
                                <input type="text" name="morada" id="morada" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="localidade">Localidade:</label>
                                <input type="text" name="localidade" id="localidade" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="codigo_postal">Código Postal:</label>
                                <input type="text" name="codigo_postal" id="codigo_postal" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="categoria">Categoria:</label><br>
                                <label for="categoria_mulher">Mulher</label>
                                <input type="checkbox" id="categoria_mulher" name="categoria[]" value="mulher"><br>
                                <label for="categoria_homem">Homem</label>
                                <input type="checkbox" id="categoria_homem" name="categoria[]" value="homem"><br>
                                <label for="categoria_crianca">Criança</label>
                                <input type="checkbox" id="categoria_crianca" name="categoria[]" value="crianca"><br>
                                <label for="categoria_outro">Outro</label>
                                <input type="checkbox" id="categoria_outro" name="categoria[]" value="outro"><br>
                            </div>

                            <div class="form-group">
                                <label for="tamanho">Tamanho:</label><br>
                                <label for="tamanho_xs">XS</label>
                                <input type="checkbox" id="tamanho_xs" name="tamanho[]" value="XS"><br>
                                <label for="tamanho_s">S</label>
                                <input type="checkbox" id="tamanho_s" name="tamanho[]" value="S"><br>
                                <label for="tamanho_m">M</label>
                                <input type="checkbox" id="tamanho_m" name="tamanho[]" value="M"><br>
                                <label for="tamanho_l">L</label>
                                <input type="checkbox" id="tamanho_l" name="tamanho[]" value="L"><br>
                                <label for="tamanho_xl">XL</label>
                                <input type="checkbox" id="tamanho_xl" name="tamanho[]" value="XL"><br>
                            </div>

                            <div class="form-group">
                                <label for="marca">Marca:</label>
                                <select id="marca" name="marca" class="form-control" required>
                                    <option value="" disabled selected>--selecione--</option>
                                    <option value="bershka">Bershka</option>
                                    <option value="tiffosi">Tiffosi</option>
                                    <option value="pullBear">Pull&Bear</option>
                                    <option value="levis">Levi's</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" name="senha" id="senha" class="form-control" minlength="8"
                                    required>
                            </div>

                            <button type="submit" class="btn-block buy-btn">Submeter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- <section id="blog-home">
        <div class="container pt-5 mt-5">
            <h2 class="font-weight-bold pt-5">Blogs</h2>
            <hr>
        </div>
    </section>

    <section id="blog-container" class="container pt-5">
        <div class="row">
            <div class="post col-lg-6 col-md-6 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/1.jpg" alt="">
                </div>
                <h3 class="text-center font-weight-normal pt-3">The best ways to change your summer wardrobe into autumn wardrobe.</h3>
                <p class="text-center">Jan 11, 2021</p>
            </div>
            <div class="post col-lg-6 col-md-6 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/2.jpg" alt="">
                </div>
                <h3 class="text-center font-weight-normal pt-3">Men's fashion in leather.</h3>
                <p class="text-center">Jan 11, 2021</p>
            </div>
            <div class="post col-lg-6 col-md-6 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/3.jpg" alt="">
                </div>
                <h3 class="text-center font-weight-normal pt-3">DIYer and TV host Trisha Hershberger’s journey through gaming keeps evolving.</h3>
                <p class="text-center">Jan 11, 2021</p>
            </div>
            <div class="post col-lg-6 col-md-6 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/4.jpg" alt="">
                </div>
                <h3 class="text-center font-weight-normal pt-3">The best ways to change your summer wardrobe into autumn wardrobe.</h3>
                <p class="text-center">Jan 11, 2021</p>
            </div>
            <div class="col-lg-12 col-md-12 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/banner.webp" alt="">
                </div>
            </div>

            <div class="post col-lg-4 col-md-6 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/1.webp" alt="">
                </div>
                <h4 class="font-weight-normal pt-3">The best ways to change your summer wardrob.</h4>
            </div>
            <div class="post col-lg-4 col-md-6 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/3.webp" alt="">
                </div>
                <h4 class="font-weight-normal pt-3">Lenovo’s smarter devices stoke professional passions</h4>
            </div>
            <div class="post col-lg-4 col-md-6 col-12 pb-5">
                <div class="post-img">
                    <img class="w-100 img-fluid" src="img/blog/2.webp" alt="">
                </div>
                <h4 class="font-weight-normal pt-3">Take a 3D tour through a Microsoft datacenter</h4>
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
        integrity="sha384-j0CNLUeiqtyaRmlzUHcodigo_postalZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous">
    </script>
</body>

</html>