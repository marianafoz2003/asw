<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatísticas Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />


    <style>
    .align-self-center {
        padding: 0 20px;
    }
    </style>
</head>

<body>

    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <a href="pagInicialAdmin.php">
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
                    <li class="nav-item">
                        <a class="nav-link" href="procuraAdmin.php">Procura</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estatisticasAdmin.php">Estatísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre nós</a>
                    </li>
                    <li class="nav-item">
                        <i class="fal fa-search"></i>
                        <i onclick="window.location.href='cart.php';" class="fal fa-shopping-bag"></i>
                    </li>
            </div>
        </div>
    </nav>


    <div class="pt-5 container mt-5 justify-content-center">



        <div class="pt-5 container mt-5 justify-content-center">

            <?php
          // include the file that establishes the database connection
          include ("abreconn.php");

          // execute count queries on each table
          $utilizadores_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM utilizador"))[0];
          $produto_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM produto"))[0];
          $favoritos_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM favoritos"))[0];
          $vendas_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM compra"))[0];
	  $utilizadores_feminino_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM utilizador WHERE genero = 'feminino'"))[0];
          $utilizadores_masculino_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM utilizador WHERE genero = 'masculino'"))[0];
          $utilizadores_outro_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM utilizador WHERE genero = 'outro'"))[0];
          ?>

            <div class="container-fluid">
                <section>
                    <div class="row">
                        <div class="col-12 mt-3 mb-1">
                            <h2>Estatísticas do Administrador</h2>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                                            </div>
                                            <div>
                                                <h4>Utilizadores</h4>
                                                <p class="mb-0">Total de Utilizadores</p>
                                            </div>
                                        </div>
                                        <div class="align-self-center">
                                            <h2 class="h1 mb-0" id="utilT"><?php echo $utilizadores_count; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                            </div>
                                            <div>
                                                <h4>Produtos</h4>
                                                <p class="mb-0">Total de Produtos</p>
                                            </div>
                                        </div>
                                        <div class="align-self-center">
                                            <h2 class="h1 mb-0" id="prodT"><?php echo $produto_count; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <h2 class="h1 mb-0 me-4" id="favT"><?php echo $favoritos_count; ?></h2>
                                            </div>
                                            <div>
                                                <h4>Favoritos</h4>
                                                <p class="mb-0">Total de Favoritos</p>
                                            </div>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="far fa-heart text-danger fa-3x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <h2 class="h1 mb-0 me-4" id="vendasT"><?php echo $vendas_count; ?></h2>
                                            </div>
                                            <div>
                                                <h4>Vendas</h4>
                                                <p class="mb-0">Total de Vendas</p>
                                            </div>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-wallet text-success fa-3x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>


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
