<?php
session_start();
include "abreconn.php";

$ok = isset($_SESSION['email']);


if($ok){
    $nome = $_SESSION['nome'];
}
// print_r($nome);

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
    <title>Preferências</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <style>
    li {
        padding: 4px;
        list-style-type: none;
    }

    button {
        text-transform: none;
    }
    </style>
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
                        <h2 class="text-center mb-4">Alterar Preferências</h2>
                        <?php
				$email = $_SESSION['email'];
				$sql = "SELECT * FROM utilizador WHERE email = '" . $email . "'";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$id = $row['id'];
				$marca = $row['marca'];

				$sql3 = "SELECT * FROM marca WHERE id = '" . $marca . "'";
				$result3 = $conn->query($sql3);
				$row3 = $result3->fetch_assoc();
				$marca = $row3['nome'];

				$sql1 = "SELECT * FROM utilizador_categoria WHERE utilizador = '" . $id . "'";
				$result1 = $conn->query($sql1);

				$categorias = array(); // Store multiple categories

				while ($row1 = $result1->fetch_assoc()) {
				    $categoria_id = $row1['categoria'];
				    $sql4 = "SELECT * FROM categoria WHERE id = '" . $categoria_id . "'";
				    $result4 = $conn->query($sql4);
				    $row4 = $result4->fetch_assoc();
				    $categoria_nome = $row4['nome'];

				    $categorias[] = $categoria_nome;
				}

				$sql2 = "SELECT * FROM utilizador_tamanho WHERE utilizador = '" . $id . "'";
				$result2 = $conn->query($sql2);

				$tamanhos = array(); // Store multiple tamanhos

				while ($row2 = $result2->fetch_assoc()) {
				    $tamanho_id = $row2['tamanho'];
				    $sql5 = "SELECT * FROM tamanho WHERE id = '" . $tamanho_id . "'";
				    $result5 = $conn->query($sql5);
				    $row5 = $result5->fetch_assoc();
				    $tamanho_nome = $row5['nome'];

				    $tamanhos[] = $tamanho_nome;
				}
				?>

                        <form method="POST" action="processaPref.php">

                            <div class="form-group">
                                <label for="categoria" style="font-weight: bold; font-size:20px;">Categoria:</label>

                                <ul>
                                    <li>
                                        <?php if (in_array('mulher', $categorias)) : ?>
                                        <input type="hidden" name="categoria[]" value="mulher">
                                        Mulher
                                        <button type="submit" name="remove_categoria" value="mulher"
                                            class="btn btn-danger">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="categoria[]" value="mulher">
                                        Mulher
                                        <button class="btn btn-success" type="submit" name="add_categoria"
                                            value="mulher">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (in_array('homem', $categorias)) : ?>
                                        <input type="hidden" name="categoria[]" value="homem">
                                        Homem
                                        <button class="btn btn-danger" type="submit" name="remove_categoria"
                                            value="homem">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="categoria[]" value="homem">
                                        Homem
                                        <button class="btn btn-success" type="submit" name="add_categoria"
                                            value="homem">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (in_array('crianca', $categorias)) : ?>
                                        <input type="hidden" name="categoria[]" value="crianca">
                                        Criança
                                        <button class="btn btn-danger" type="submit" name="remove_categoria"
                                            value="crianca">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="categoria[]" value="crianca">
                                        Criança
                                        <button class="btn btn-success" type="submit" name="add_categoria"
                                            value="crianca">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (in_array('outro', $categorias)) : ?>
                                        <input type="hidden" name="categoria[]" value="outro">
                                        Outro
                                        <button class="btn btn-danger" type="submit" name="remove_categoria"
                                            value="outro">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="categoria[]" value="outro">
                                        Outro
                                        <button class="btn btn-success" type="submit" name="add_categoria"
                                            value="outro">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>



                            <div class="form-group">
                                <label for="tamanho" style="font-weight: bold; font-size:20px;">Tamanho:</label>
                                <ul>
                                    <li>
                                        <?php if (in_array('XS', $tamanhos)) : ?>
                                        <input type="hidden" name="tamanho[]" value="XS">
                                        XS
                                        <button class="btn btn-danger" type="submit" name="remove_tamanho"
                                            value="XS">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="tamanho[]" value="XS">
                                        XS
                                        <button class="btn btn-success" type="submit" name="add_tamanho"
                                            value="XS">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (in_array('S', $tamanhos)) : ?>
                                        <input type="hidden" name="tamanho[]" value="S">
                                        S
                                        <button class="btn btn-danger" type="submit" name="remove_tamanho"
                                            value="S">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="tamanho[]" value="S">
                                        S
                                        <button class="btn btn-success" type="submit" name="add_tamanho"
                                            value="S">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (in_array('M', $tamanhos)) : ?>
                                        <input type="hidden" name="tamanho[]" value="M">
                                        M
                                        <button class="btn btn-danger" type="submit" name="remove_tamanho"
                                            value="M">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="tamanho[]" value="M">
                                        M
                                        <button class="btn btn-success" type="submit" name="add_tamanho"
                                            value="M">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (in_array('L', $tamanhos)) : ?>
                                        <input type="hidden" name="tamanho[]" value="L">
                                        L
                                        <button class="btn btn-danger" type="submit" name="remove_tamanho"
                                            value="L">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="tamanho[]" value="L">
                                        L
                                        <button class="btn btn-success" type="submit" name="add_tamanho"
                                            value="L">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (in_array('XL', $tamanhos)) : ?>
                                        <input type="hidden" name="tamanho[]" value="XL">
                                        XL
                                        <button class="btn btn-danger" type="submit" name="remove_tamanho"
                                            value="XL">Remover</button>
                                        <?php else: ?>
                                        <input type="hidden" name="tamanho[]" value="XL">
                                        XL
                                        <button class="btn btn-success" type="submit" name="add_tamanho"
                                            value="XL">Adicionar</button>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>




                            <div class="form-group">
                                <label for="marca" style="font-weight: bold; font-size:20px;">Marca: (Atual:
                                    <?php echo $marca ?>)</label>
                                <select id="marca" name="marca" class="form-control">
                                    <option value="0" selected>Não Alterar</option>
                                    <option value="bershka">Bershka</option>
                                    <option value="tiffosi">Tiffosi</option>
                                    <option value="pullBear">Pull&Bear</option>
                                    <option value="levis">Levi's</option>
                                </select>
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
                    <li><a href="#">Mulher</a></li>
                    <li><a href="#">Homem</a></li>
                    <li><a href="#">Menino</a></li>
                    <li><a href="#">Menina</a></li>
                    <li><a href="#">Bebé</a></li>
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
</body>

</html>