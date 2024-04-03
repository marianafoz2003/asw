<?php
session_start();
include "abreconn.php";

$ok = isset($_SESSION['email']);

$sql = "SELECT * FROM utilizador WHERE email = '" . $_SESSION['email'] . "'";
$result = $conn->query($sql);
$dados = $result->fetch_assoc();
$idCom = $dados['id'];


if ($ok) {
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
}

if (isset($_GET['id']) && isset($_GET['vend'])) {
    $id = $_GET['id'];
    $vend = $_GET['vend'];
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
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


.card {
    background: #fff;
    transition: .5s;
    border: 0;
    margin-bottom: 30px;
    border-radius: .55rem;
    position: relative;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}

.chat-app .people-list {
    width: 280px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 20px;
    z-index: 7
}

.chat-app .chat {
    margin-left: 280px;
    border-left: 1px solid #eaeaea
}

.people-list {
    -moz-transition: .5s;
    -o-transition: .5s;
    -webkit-transition: .5s;
    transition: .5s
}

.people-list .chat-list li {
    padding: 10px 15px;
    list-style: none;
    border-radius: 3px
}

.people-list .chat-list li:hover {
    background: #efefef;
    cursor: pointer
}

.people-list .chat-list li.active {
    background: #efefef
}

.people-list .chat-list li .name {
    font-size: 15px
}

.people-list .chat-list img {
    width: 45px;
    border-radius: 50%
}

.people-list img {
    float: left;
    border-radius: 50%
}

.people-list .about {
    float: left;
    padding-left: 8px
}

.people-list .status {
    color: #999;
    font-size: 13px
}

.chat .chat-header {
    padding: 15px 20px;
    border-bottom: 2px solid #f4f7f6
}

.chat .chat-header img {
    float: left;
    border-radius: 40px;
    width: 40px
}

.chat .chat-header .chat-about {
    float: left;
    padding-left: 10px
}

.chat .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff
}

.chat .chat-history ul {
    padding: 0
}

.chat .chat-history ul li {
    list-style: none;
    margin-bottom: 30px
}

.chat .chat-history ul li:last-child {
    margin-bottom: 0px
}

.chat .chat-history .message-data {
    margin-bottom: 15px
}

.chat .chat-history .message-data img {
    border-radius: 40px;
    width: 40px
}

.chat .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px
}

.chat .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative
}

.chat .chat-history .message:after {
    bottom: 100%;
    left: 7%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
    margin-left: -30px
}

.chat .chat-history .my-message {
    background: #efefef
}

.chat-app .people-list {
    height: 600px;
    overflow-y: scroll;
}

.chat .chat-history {
    height: 450px;
    overflow-y: scroll;
}

.chat .chat-history .my-message:after {
    bottom: 100%;
    left: 30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #efefef;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .other-message {
    background: #e8f1f3;
    text-align: right
}

.chat .chat-history .other-message:after {
    border-bottom-color: #e8f1f3;
    left: 93%
}

.chat .chat-message {
    padding: 20px
}

.online,
.offline,
.me {
    margin-right: 2px;
    font-size: 8px;
    vertical-align: middle
}

.online {
    color: #86c541
}

.offline {
    color: #e47297
}

.me {
    color: #1d8ecd
}

.float-right {
    float: right
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
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



    <br>
    <br><br><br>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <?php
                        $sql3 = "SELECT * FROM chat WHERE utilizador1 = '$idCom' OR utilizador2 = '$idCom'";
                        $result2 = mysqli_query($conn, $sql3);

                        $chats = array(); // Array to store unique chats

                        if ($result2->num_rows > 0) {
                            while ($con = $result2->fetch_assoc()) {
                                $idVen = ($con['utilizador1'] == $idCom) ? $con['utilizador2'] : $con['utilizador1'];
                                $idP = $con['produto'];

                                // Check if the chat with the same vendor and product exists in the array
                                $chatExists = false;
                                foreach ($chats as $chat) {
                                    if ($chat['vendedor'] == $idVen && $chat['produto'] == $idP) {
                                        $chatExists = true;
                                        break;
                                    }
                                }

                                if ($chatExists) {
                                    continue; // Skip the current chat iteration
                                }

                                $chats[] = array(
                                    'vendedor' => $idVen,
                                    'produto' => $idP
                                );

                                $sql5 = "SELECT * FROM utilizador WHERE id = '$idVen'";
                                $result5 = mysqli_query($conn, $sql5);
                                $row5 = mysqli_fetch_assoc($result5);
                                $nomeVen = $row5['nome'];

                                $sql6 = "SELECT * FROM produto WHERE id = '$idP'";
                                $result6 = mysqli_query($conn, $sql6);
                                $row6 = mysqli_fetch_assoc($result6);
                                $tit1 = $row6['titulo'];
                                $vendedor = $row6['vendedor'];

                                ?>
                            <li class="clearfix" data-chat-id="<?php echo $idP; ?>"
                                data-vendor-id="<?php echo $idVen; ?>">
                                <img src="https://www.gov.br/cdn/sso-status-bar/src/image/user.png" alt="avatar">
                                <div class="about">
                                    <div class="name"><?php echo $nomeVen; ?></div>
                                    <div class="status"><?php echo $tit1; ?></div>
                                </div>
                            </li>
                            <?php
                            }
                        } else {
                            echo 'Ainda não tem conversas :(';
                        }
                        ?>
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://www.gov.br/cdn/sso-status-bar/src/image/user.png"
                                            alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0 chat-participant"></h6>
                                        <small class="chat-product-title"
                                            onclick="window.location.href='sproduct.php?id= <?php echo $id ?>';"
                                            style="cursor: pointer; color: black; font-size: 14px;"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0 chat-message-list">

                                <li class="no-conversation-placeholder">Selecione uma conversa</li>

                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <form id="chat-form">
                                <div class="input-group mb-0">
                                    <input id="mdg" name="msg" type="text" class="form-control"
                                        placeholder="Enter text here..." required>
                                    <input type="hidden" name="id" value="" id="chat-product-id">
                                    <input type="hidden" name="vend" value="" id="chat-vendor-id">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="input-group-text"><i
                                                class="fa fa-send"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".chat-list li").click(function() {
            var chatProductId = $(this).data("chat-id");
            var chatVendorId = $(this).data("vendor-id");
            var chatParticipant = $(this).find(".name").text();
            var chatProductTitle = $(this).find(".status").text();


            $(".chat-participant").text(chatParticipant);
            $(".chat-product-title").text(chatProductTitle);
            $("#chat-product-id").val(chatProductId);
            $("#chat-vendor-id").val(chatVendorId);


            retrieveChatMessages(chatProductId, chatVendorId);
        });

        $("#chat-form").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "processaChat.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    var chatProductId = $("#chat-product-id").val();
                    var chatVendorId = $("#chat-vendor-id").val();
                    retrieveChatMessages(chatProductId, chatVendorId);
                    $("#mdg").val("");
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        function retrieveChatMessages(chatProductId, chatVendorId) {
            $.ajax({
                url: "retrieveChatMessages.php",
                type: "POST",
                data: {
                    id: chatProductId,
                    vend: chatVendorId
                },
                success: function(response) {
                    $(".chat-message-list").html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        if (!$(".chat-list li").hasClass("active")) {
            $(".no-conversation-placeholder").show();
        }
    });
    </script>







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
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Handle form submission using AJAX
        $('#message-form').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Get form data as string

            $.ajax({
                url: 'processaChat.php', // Specify the URL endpoint for the AJAX request
                type: 'POST', // Set the HTTP method as POST
                data: formData, // Pass the form data to the server
                success: function(response) {
                    // Handle the successful response from the server
                    // Update the chat history or perform any other actions
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }
            });
        });
    });
    </script>


</body>

</html>