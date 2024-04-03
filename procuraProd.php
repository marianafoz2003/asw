< <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Procura Admin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
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
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span><i id="bar" class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Loja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="procuraAdmin.php">Procura Utilizadores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="procuraProd.php">Procura Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="estatisticasAdmin.php">Estatísticas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre nós</a>
                        </li>

                </div>
            </div>
        </nav>

        <div class="pt-5 container mt-5 justify-content-center">
            <div class="row">
                <div class="col-3 coluna1">
                    <div class="container">
                        <div class="row">
                            <div style="display:flex">
                                <h2> Filtros</h2>
                            </div>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="nome">Título:</label>
                                    <input type="text" name="nome" id="nome" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label for="dataReg">Data Registo:</label>
                                    <input type="date" name="dataReg" id="dataReg" class="form-control" min="0">

                                </div>

                                <div class="form-group">
                                    <label for="estado">Estado:</label>
                                    <select id="estado" name="estado" class="form-control">
                                        <option value="todos" disabled selected>--selecione--</option>
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
                                        <option value="todos" disabled selected>--selecione--</option>
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
                                        <option value="todos" disabled selected>--selecione--</option>
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
                                        <option value="todos" disabled selected>--selecione--</option>
                                        <option value="1">Mulher</option>
                                        <option value="2">Homem</option>
                                        <option value="3">Criança</option>
                                        <option value="4">Outro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca:</label>
                                    <select id="marca" name="marca" class="form-control">
                                        <option value="todos" disabled selected>--selecione--</option>
                                        <option value="0">Bershka</option>
                                        <option value="1">Tiffosi</option>
                                        <option value="2">Pull&Bear</option>
                                        <option value="3">Levi's</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn-block buy-btn">Pesquisar</button>
                                <button type="clean" class="btn-block buy-btn" href="#">Limpar filtros</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-9">
                    <div class="card p-3">
                        <p> Produtos da FCUL2HandCloth </p>
                        <div style="overflow-x:auto;">
                            <?php

                        
                               
                                
                    include("abreconn.php");

                    // Build the SQL query based on the filter input values
                    $sql = "SELECT * FROM produto WHERE 1=1";
                    if (!empty($_POST['nome'])) {
                        $nome = $_POST['nome'];
                        $sql .= " AND titulo LIKE '%$nome%'";
                    }

                    if (isset($_POST['dataReg']) && !empty($_POST['dataReg'])) {
                            $sql .= " AND dataRegisto = '{$_POST['dataReg']}'";
                        }
                    
                        if (!empty($_POST['estado'])  && $_POST['estado'] != 'todos') {
                        $estado = $_POST['estado'];
                        $sql .= " AND estado = '$estado'";
                    }
                    if (!empty($_POST['tipo'])  && $_POST['tipo'] != 'todos') {
                        $tipo = $_POST['tipo'];
                        $sql .= " AND tipo = '$tipo'";
                    }
                     if (!empty($_POST['tamanho'])  && $_POST['tamanho'] != 'todos') {
                        $tamanho = $_POST['tamanho'];
                        $sql .= " AND tamanho = '$tamanho'";
                    }
                    if (!empty($_POST['categoria'])  && $_POST['categoria'] != 'todos') {
                        $categoria = $_POST['categoria'];
                        $sql .= " AND categoria = '$categoria'";
                    }
                    if (!empty($_POST['marca'])  && $_POST['marca'] != 'todos') {
                        $marca = $_POST['marca'];
                        $sql .= " AND marca = '$marca'";
                    }
                    
                    

                    $result = $conn->query($sql);

                    // Output table
                    if ($result->num_rows > 0) {
                        echo "<table><tr><th>ID</th><th>Título</th><th>Data de Registo</th><th>Estado</th><th>Tipo</th><th>Tamanho</th><th>Categoria</th><th>Marca</th></tr>";
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            if($row["tamanho"] == 1)
                                $tamnhoNome = "XS";
                            else if($row["tamanho"] == 2)
                                $tamnhoNome = "S";
                            else if($row["tamanho"] == 3)
                                $tamnhoNome = "M";
                            else if($row["tamanho"] == 4)
                                $tamnhoNome = "L";
                            else if($row["tamanho"] == 5)
                                $tamnhoNome = "XL";
                            else
                                $tamnhoNome = "N/A";
                            if ($row["categoria"] == 1)
                                $categoriaNome = "Mulher";
                            else if ($row["categoria"] == 2)
                                $categoriaNome = "Homem";
                            else if ($row["categoria"] == 3)
                                $categoriaNome = "Criança";
                            else if ($row["categoria"] == 4)
                                $categoriaNome = "Outro";
                            else
                                $categoriaNome = "N/A";
                            if ($row["marca"] == 0)
                                $marcaNome = "Bershka";
                            else if ($row["marca"] == 1)
                                $marcaNome = "Tiffosi";
                            else if ($row["marca"] == 2)
                                $marcaNome = "Pull&Bear";
                            else if ($row["marca"] == 3)
                                $marcaNome = "Levi's";
                            else
                                $marcaNome = "N/A";
                            

                            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["titulo"] . "</td><td>" . $row["dataRegisto"] . "</td><td>" . $row["estado"] . "</td><td>" . $row["tipo"] . "</td><td>" . $tamnhoNome . "</td><td>" . $categoriaNome . "</td><td>" . $marcaNome . "</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }

                    // Close database connection
                    $conn->close();
                    ?>


                        </div>
                    </div>
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
            integrity="sha384-j0CNLUeiqtyaRmlzUHcodigo_postalZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
            crossorigin="anonymous">
        </script>
    </body>


    <script>

    </script>