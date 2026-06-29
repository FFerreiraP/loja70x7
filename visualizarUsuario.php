<?php

include "header.php";
include "conexaoBD.php";

if (isset($_GET['idUsuario'])) {

    $idUsuario = (int) $_GET['idUsuario'];

    $buscarUsuario = "
        SELECT *
        FROM usuarios
        WHERE idUsuario = $idUsuario
    ";

    $resUsuario = mysqli_query($conn, $buscarUsuario);

    if (mysqli_num_rows($resUsuario) > 0) {

        $usuario = mysqli_fetch_assoc($resUsuario);

        $fotoUsuario = $usuario['fotoUsuario'];
        $nomeUsuario = $usuario['nomeUsuario'];
        $dataNascimentoUsuario = $usuario['dataNascimentoUsuario'];
        $cidadeUsuario = $usuario['cidadeUsuario'];
        $emailUsuario = $usuario['emailUsuario'];

    } else {

        echo "<div class='alert alert-danger text-center'>Usuário não encontrado!</div>";
        include "footer.php";
        exit();

    }

} else {

    echo "<div class='alert alert-danger text-center'>ID do usuário não informado!</div>";
    include "footer.php";
    exit();

}

?>

<style>
    .img-produto-principal {
        width: 100%;
        max-height: 450px;
        object-fit: contain;
    }
</style>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">

        <div class="row gx-5 align-items-center">

            <div class="col-md-5 text-center">

                <img class="img-produto-principal rounded shadow" <?php echo $Usuario['fotoUsuario']; ?>
                    src="<?php echo htmlspecialchars($fotoUsuario); ?>"
                    alt="<?php echo htmlspecialchars($nomeUsuario); ?>">

            </div>

            <div class="col-md-7">

                <h1 class="display-5 fw-bold">
                    <?php echo htmlspecialchars($nomeUsuario); ?>
                </h1>

                <hr>

                <p>
                    <strong><i class="bi bi-envelope-fill"></i> E-mail:</strong><br>
                    <?php echo htmlspecialchars($emailUsuario); ?>
                </p>

                <p>
                    <strong><i class="bi bi-geo-alt-fill"></i> Cidade:</strong><br>
                    <?php echo htmlspecialchars($cidadeUsuario); ?>
                </p>

                <p>
                    <strong><i class="bi bi-calendar-event-fill"></i> Data de Nascimento:</strong><br>
                    <?php echo date('d/m/Y', strtotime($dataNascimentoUsuario)); ?>
                </p>

                <hr>

                <a href="formEditarUsuario.php?idUsuario=<?php echo $idUsuario; ?>" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i>
                    Editar Usuário
                </a>
                <a href="actionExcluirUsuario.php#?idUsuario=<?php echo $idUsuario; ?>" class="btn btn-danger"
                    onclick="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita!')">
                    <i class="bi bi-trash"></i>
                    Excluir Usuário
                </a>

                <a href="listarUsuarios.php#Usuarios" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Voltar
                </a>

            </div>

        </div>

    </div>
</section>

<?php include "footer.php"; ?>