<?php

session_start();

include "conexaoBD.php";

$idUsuario = (int) $_POST['idUsuario'];

$nomeUsuario = mysqli_real_escape_string($conn, $_POST['nomeUsuario']);
$dataNascimentoUsuario = $_POST['dataNascimentoUsuario'];
$cidadeUsuario = mysqli_real_escape_string($conn, $_POST['cidadeUsuario']);
$emailUsuario = mysqli_real_escape_string($conn, $_POST['emailUsuario']);
$nivelUsuario = mysqli_real_escape_string($conn, $_POST['nivelUsuario']);

// Buscar foto atual
$sql = "SELECT fotoUsuario FROM usuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    $fotoUsuario = $usuario['fotoUsuario'];
} else {
    die("Usuário não encontrado.");
}

$erroUpload = false;

// Upload da foto
if ($_FILES["fotoUsuario"]["size"] != 0) {

    $diretorio = "assets/img/";
    $fotoNova = $diretorio . basename($_FILES["fotoUsuario"]["name"]);
    $tipoDaImagem = strtolower(pathinfo($fotoNova, PATHINFO_EXTENSION));

    // Validação do tamanho (5MB)
    if ($_FILES["fotoUsuario"]["size"] > 5000000) {
        echo "<div class='alert alert-warning text-center'>
                O campo <strong>FOTO</strong> deve ter tamanho máximo de 5MB!
              </div>";
        $erroUpload = true;
    }

    // Validação da extensão
    if (
        $tipoDaImagem != "jpg" &&
        $tipoDaImagem != "jpeg" &&
        $tipoDaImagem != "png" &&
        $tipoDaImagem != "webp"
    ) {
        echo "<div class='alert alert-warning text-center'>
                A <strong>FOTO</strong> deve estar nos formatos JPG, JPEG, PNG ou WEBP!
              </div>";
        $erroUpload = true;
    }

    if (!$erroUpload) {

        if (move_uploaded_file($_FILES["fotoUsuario"]["tmp_name"], $fotoNova)) {

            // Remove a foto antiga
            if (!empty($fotoUsuario) && file_exists($fotoUsuario)) {
                unlink($fotoUsuario);
            }

            $fotoUsuario = $fotoNova;

        } else {

            echo "<div class='alert alert-danger text-center'>
                    Erro ao enviar a foto!
                  </div>";
            exit();

        }

    } else {
        exit();
    }

}

// Atualizar usuário
$sqlEditar = "
UPDATE usuarios
SET
    nomeUsuario = '$nomeUsuario',
    dataNascimentoUsuario = '$dataNascimentoUsuario',
    cidadeUsuario = '$cidadeUsuario',
    emailUsuario = '$emailUsuario',
    nivelUsuario = '$nivelUsuario',
    fotoUsuario = '$fotoUsuario'
WHERE idUsuario = $idUsuario
";

if (mysqli_query($conn, $sqlEditar)) {

    // Atualiza os dados da sessão se o usuário editou o próprio perfil
    if (isset($_SESSION['idUsuario']) && $_SESSION['idUsuario'] == $idUsuario) {

        $_SESSION['nomeUsuario'] = $nomeUsuario;
        $_SESSION['emailUsuario'] = $emailUsuario;
        $_SESSION['nivelUsuario'] = $nivelUsuario;

    }

    header("Location: visualizarUsuario.php?idUsuario=" . $idUsuario);
    exit();

} else {

    echo "<div class='alert alert-danger text-center'>
            Erro ao atualizar usuário:<br>
            " . mysqli_error($conn) . "
          </div>";

}

?>