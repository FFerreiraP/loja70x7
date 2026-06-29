<?php

session_start();
include "conexaoBD.php";

if (!isset($_GET['idUsuario'])) {
    die("ID não informado.");
}

$idUsuario = (int) $_GET['idUsuario'];

/* Buscar foto do usuário */
$sql = "SELECT fotoUsuario FROM usuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {

    $usuario = mysqli_fetch_assoc($resultado);
    $fotoUsuario = $usuario['fotoUsuario'];

    // apagar imagem do servidor
    if (!empty($fotoUsuario) && file_exists($fotoUsuario)) {
        unlink($fotoUsuario);
    }

} else {
    die("Usuário não encontrado.");
}

/* Excluir do banco */
$sqlDelete = "DELETE FROM usuarios WHERE idUsuario = $idUsuario";

if (mysqli_query($conn, $sqlDelete)) {

    // se for o usuário logado, desloga
    if (isset($_SESSION['idUsuario']) && $_SESSION['idUsuario'] == $idUsuario) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    header("Location: listarUsuarios.php");
    exit();

} else {

    echo "<div class='alert alert-danger text-center'>
            Erro ao excluir usuário: " . mysqli_error($conn) . "
          </div>";

}

?>