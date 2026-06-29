<?php
include "conexaoBD.php";
session_start();

// verifica login
if (!isset($_SESSION['idUsuario'])) {
    die("Você precisa estar logado.");
}

if (!isset($_GET['idAnuncio'])) {
    die("ID do anúncio não informado.");
}

$idAnuncio = (int) $_GET['idAnuncio'];
$idUsuario = (int) $_SESSION['idUsuario'];

// busca anúncio e verifica se pertence ao usuário
$sql = "
    SELECT fotoAnuncio 
    FROM anuncios 
    WHERE idAnuncio = $idAnuncio 
    AND Usuarios_idUsuario = $idUsuario
";

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) == 0) {
    die("Anúncio não encontrado ou sem permissão.");
}

$anuncio = mysqli_fetch_assoc($res);
$foto = $anuncio['fotoAnuncio'];

// apaga do banco
$delete = "
    DELETE FROM anuncios
    WHERE idAnuncio = $idAnuncio
    AND Usuarios_idUsuario = $idUsuario
";

if (mysqli_query($conn, $delete)) {

    // remove imagem do servidor
    if (!empty($foto) && file_exists($foto)) {
        unlink($foto);
    }

    header("Location: index.php?msg=anuncio_excluido");
    exit;

} else {
    echo "Erro ao excluir anúncio: " . mysqli_error($conn);
}
?>