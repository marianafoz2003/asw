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
    <title>Loja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
</head>
<style>
.form-group {
    display: inline-block;
    margin-right: 20px;
    vertical-align: top;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

select,
input[type="text"] {
    display: block;
    width: 200px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

button {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    font-size: 16px;
    cursor: pointer;
}

button[type="clean"] {
    background-color: #ccc;
    color: #444;
    margin-left: 10px;
}

button:hover {
    background-color: #0069d9;
}

button[type="clean"]:hover {
    background-color: #bbb;
}

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

                    echo $userAuth
                    ?>




            </div>
        </div>
    </nav>
    <section id="featured" class="my-5 py-5">
        <div class="container mt-5 py-5">
            <h2 class="font-weight-bold">Loja</h2>
            <hr>
            <div class="form-row">
                <div class="form-group">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="">Todos</option>
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
                                <option value="">Todos</option>
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
                                <option value="">Todos</option>
                                <option value="1">XS</option>
                                <option value="2">S</option>
                                <option value="3">M</option>
                                <option value="4">L</option>
                                <option value="5">XL</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria:</label>
                            <select id="categoria" name="categoria" class="form-control">
                                <option value="">Todos</option>
                                <option value="1">Mulher</option>
                                <option value="2">Homem</option>
                                <option value="3">Criança</option>
                                <option value="4">Outro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <select id="marca" name="marca" class="form-control">
                                <option value="">Todos</option>
                                <option value="0">Bershka</option>
                                <option value="1">Tiffosi</option>
                                <option value="2">Pull&Bear</option>
                                <option value="3">Levi's</option>
                            </select>
                        </div>
                        <button type="submit" class="buy-btn">Filtrar
                        </button>
                        <button type="clean" class="buy-btn" href=" #">Limpar filtros</button>
                    </form>
                </div>
            </div>
            <div class="row mx-auto container">
                <?php
                if ($ok) {
                    $sql_query1 = "SELECT * FROM utilizador WHERE email = '$email'";
                    $result1 = $conn->query($sql_query1);
                    $row1 = $result1->fetch_assoc();
                    $id = $row1['id'];

                    
    $sql = "SELECT * FROM produto p WHERE NOT EXISTS 
    (SELECT * FROM compra c WHERE c.produto = p.id) AND p.vendedor != $id AND 1=1";
    if(isset($_POST['titulo']) && $_POST['titulo'] != ''){
        $sql .= " AND p.titulo LIKE '%".$_POST['titulo']."%'";
    }
    if(isset($_POST['estado']) && $_POST['estado'] != ''){
        $sql .= " AND p.estado LIKE '%".$_POST['estado']."%'";
    }
    if(isset($_POST['tipo']) && $_POST['tipo'] != ''){
        $sql .= " AND p.tipo LIKE '%".$_POST['tipo']."%'";
    }
    if(isset($_POST['tamanho']) && $_POST['tamanho'] != ''){
        $sql .= " AND p.tamanho LIKE '%".$_POST['tamanho']."%'";
    }
    if(isset($_POST['categoria']) && $_POST['categoria'] != ''){
        $sql .= " AND p.categoria LIKE '%".$_POST['categoria']."%'";
    }
    if(isset($_POST['marca']) && $_POST['marca'] != ''){
        $sql .= " AND p.marca LIKE '%".$_POST['marca']."%'";
    }
                } else {
                    $sql = "SELECT * FROM produto p WHERE NOT EXISTS 
    (SELECT * FROM compra c WHERE c.produto = p.id) AND 1=1";
                    if (isset($_POST['titulo']) && $_POST['titulo'] != '') {
                        $sql .= " AND p.titulo LIKE '%" . $_POST['titulo'] . "%'";
                    }
                    if (isset($_POST['estado']) && $_POST['estado'] != '') {
                        $sql .= " AND p.estado LIKE '%" . $_POST['estado'] . "%'";
                    }
                    if (isset($_POST['tipo']) && $_POST['tipo'] != '') {
                        $sql .= " AND p.tipo LIKE '%" . $_POST['tipo'] . "%'";
                    }
                    if (isset($_POST['tamanho']) && $_POST['tamanho'] != '') {
                        $sql .= " AND p.tamanho LIKE '%" . $_POST['tamanho'] . "%'";
                    }
                    if (isset($_POST['categoria']) && $_POST['categoria'] != '') {
                        $sql .= " AND p.categoria LIKE '%" . $_POST['categoria'] . "%'";
                    }
                    if (isset($_POST['marca']) && $_POST['marca'] != '') {
                        $sql .= " AND p.marca LIKE '%" . $_POST['marca'] . "%'";
                    }
                }

    $sql_query= $conn->query($sql);
    if($sql_query->num_rows > 0){
        while($produto = $sql_query->fetch_assoc()){
    ?>


                <div class="product col-lg-3 col-md-4 col-12 text-center">
                    <!-- <i class="fas fa-heart"></i> -->
                    <img class="mb-3 img-fluid" src="<?php echo $produto['imagem']; ?>" alt="">
                    <h5 class="p-name"><?php echo $produto['titulo']; ?></h5>
                    <h4 class="p-price"><?php echo $produto['preco']; print(' €'); ?></h4>
                    <button class="buy-btn"
                        onclick="window.location.href='sproduct.php?id=<?php echo urlencode($produto['id']); ?>';">Comprar</button>
                    <?php
if($ok){
    echo "<button class='btn1' onClick='addFav(fav".$produto['id'].")' value='".$produto['id']."' id='fav".$produto['id']."'><i class='fas fa-heart'></i></button>";
}
?>
                </div>

                <?php 
                }
            } else{
                echo "<p>Ainda não temos produtos. Pedimos desculpa :(</p>";
            }
            ?>
            </div>
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
    <script>
    function addFav(str) {
        console.log(str);
        var button = document.getElementById(str);
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "addFavLoja.php?fav=" + str.value, true);
        xhttp.send();
        //window.location = "addFavLoja.php";
    }
    </script>
</body>

</html>
