<?php
include "header.php";
include "conexaoBD.php";

if (!isset($_GET['idUsuario'])) {
    echo "<div class='alert alert-danger text-center'>Usuário não informado!</div>";
    include "footer.php";
    exit();
}

$idUsuario = (int) $_GET['idUsuario'];

$sql = "SELECT * FROM usuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) == 0) {
    echo "<div class='alert alert-danger text-center'>Usuário não encontrado!</div>";
    include "footer.php";
    exit();
}

$usuario = mysqli_fetch_assoc($resultado);
?>

<section class="py-5">
    <div class="container" id="Usuario">

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card shadow">

                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-0">
                            <i class="bi bi-pencil-square"></i>
                            Editar Usuário
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="actionEditarUsuario.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="idUsuario" value="<?php echo $usuario['idUsuario']; ?>">

                            <div class="text-center mb-4">

                                <img src="<?php echo $usuario['fotoUsuario']; ?>" class="rounded-circle shadow"
                                    width="180" height="180" style="object-fit:cover;">

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nova Foto</label>
                                <input type="file" name="fotoUsuario" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nomeUsuario"
                                    value="<?php echo $usuario['nomeUsuario']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="emailUsuario"
                                    value="<?php echo $usuario['emailUsuario']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cidade</label>
                                <select class="form-select" id="cidadeUsuario" name="cidadeUsuario" required>
                                    <option value="Curiúva" <?php if ($usuario['cidadeUsuario'] == "Curiúva")
                                        echo "selected"; ?>>Curiúva</option>
                                    <option value="Imbaú" <?php if ($usuario['cidadeUsuario'] == "Imbaú")
                                        echo "selected"; ?>>Imbaú</option>
                                    <option value="Ortigueira" <?php if ($usuario['cidadeUsuario'] == "Ortigueira")
                                        echo "selected"; ?>>Ortigueira</option>
                                    <option value="Reserva" <?php if ($usuario['cidadeUsuario'] == "Reserva")
                                        echo "selected"; ?>>Reserva</option>
                                    <option value="Telêmaco Borba" <?php if ($usuario['cidadeUsuario'] == "Telêmaco Borba")
                                        echo "selected"; ?>>Telêmaco Borba</option>
                                    <option value="Tibagi" <?php if ($usuario['cidadeUsuario'] == "Tibagi")
                                        echo "selected"; ?>>Tibagi</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" name="dataNascimentoUsuario"
                                    value="<?php echo $usuario['dataNascimentoUsuario']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nível do Usuário</label>
                                <select name="nivelUsuario" class="form-select">
                                    <option value="usuario" <?php if ($usuario['nivelUsuario'] == 'usuario')
                                        echo "selected"; ?>> Usuário </option>
                                    <option value="administrador" <?php if ($usuario['nivelUsuario'] == 'administrador')
                                        echo "selected"; ?>> Administrador</option>
                                </select>
                            </div>

                            <div class="text-center">

                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i>
                                    Salvar Alterações
                                </button>

                                <a href="visualizarUsuario.php?idUsuario=<?php echo $usuario['idUsuario']; ?>"
                                    class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i>
                                    Cancelar
                                </a>

                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<?php include "footer.php"; ?>