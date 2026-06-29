<?php

    error_reporting(0); //Desabilita alertas de erros de execução
    session_start();

    if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
        $idUsuario    = $_SESSION['idUsuario']; //Armazenar as variáveis de sessão em variáveis PHP
        $nomeUsuario  = $_SESSION['nomeUsuario'];
        $emailUsuario = $_SESSION['emailUsuario'];
        $nivelUsuario = $_SESSION['nivelUsuario'];

        $nomeCompleto = explode(' ', $nomeUsuario); //Usa a função explode para fragmentar o nome do usuário
        $primeiroNome = $nomeCompleto[0]; //Armazena na variável o primeiro [0] fragmento do nome do usuário
    }

?>

<!DOCTYPE html>
<html lang="pt">
    <?php
        //Configura o fuso horário para America/São Paulo
        date_default_timezone_set('America/Sao_Paulo');
    ?>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>LOJA 70x7</title>
        <link rel="icon" type="image/x-icon" href="assets/loja70x7.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <!-- CND para ícones do Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <!-- Fonte Rancho do Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">

    </head>
    
    <body id="page-top">
        
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <img src='assets/img/logo.png' alt='Logo 70x7' class='img-fluid mb-4' style='width:80px;'></img>
                <a class="navbar-brand" href="index.php">LOJA 70x7</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php#Produtos">Anuncios</a></li>
                    </ul>
                </div>
            </div>
            <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                        <?php
                            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
                                if($nivelUsuario == 'administrador'){
                                    echo "
                                        <li class='nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' id='navbarDropdown' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'><i class='bi bi-person-circle'></i>&nbsp$primeiroNome</a>
                                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <li><a class='dropdown-item' href='formAnuncio.php#Criar'>Criar Anúncio</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='index.php#Produtos'>Gerenciar Anúncios</a></li>
                                                <li><a class='dropdown-item' href='listarUsuarios.php#Usuarios'>Gerenciar Usuários</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='logout.php'>Sair</a></li>
                                            </ul>
                                        </li>
                                    ";
                                }
                                else{
                                    echo "
                                        <li class='nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' id='navbarDropdown' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'><i class='bi bi-person-circle'></i>&nbsp$primeiroNome</a>
                                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <li><a class='dropdown-item' href='formAnuncio.php'>Criar Anúncio</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='meusAnuncios.php'>Meus Anúncios</a></li>
                                                <li><a class='dropdown-item' href='minhasCompras.php'>Minhas Compras</a></li>
                                                <li><hr class='dropdown-divider' /></li>
                                                <li><a class='dropdown-item' href='logout.php'>Sair</a></li>
                                            </ul>
                                        </li>
                                    ";
                                }
                            }
                            else{
                                echo "<li class='nav-item'><a class='nav-link' aria-current='page' href='formLogin.php#login' title='Acessar o Sistema'>Login</a></li>";
                            }

                        ?>
            </ul>
        </nav>

        <!-- Masthead-->
        <?php 
            
            echo "
                <header class='masthead'>
                    <div class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
                        <div class='d-flex justify-content-center'>
                            <div class='text-center'>
                                <img src='assets/img/logo.png' alt='Logo 70x7'
                                    class='img-fluid mb-4'
                                    style='width:180px; height:auto;'>
                                <h1 class='mx-auto my-0 text-uppercase'>70x7</h1>
                                <h2 class='text-white-50 mx-auto mt-2 mb-5'>Ponham em prática tudo o que vocês aprenderam, receberam, ouviram e viram em mim. E o Deus da paz estará com vocês.</h2>
                                <h2 class='text-white-50 mx-auto mt-2 mb-5'> - Filipenses 4:9</h2> 
                            </div>
                        </div>
                    </div>
                </header>
            ";
            
        ?>