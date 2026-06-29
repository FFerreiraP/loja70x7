<?php
include "header.php";
include "conexaoBD.php";

// Verifica se está logado
if (!isset($_SESSION['idUsuario'])) {
    echo "
        <div class='container mt-5'>
            <div class='alert alert-danger text-center'>
                Você precisa estar logado para editar um anúncio!
            </div>
        </div>
    ";
    include "footer.php";
    exit;
}

// Verifica ID
if (!isset($_GET['idAnuncio'])) {
    echo "
        <div class='container mt-5'>
            <div class='alert alert-danger text-center'>
                Nenhum anúncio foi selecionado!
            </div>
        </div>
    ";
    include "footer.php";
    exit;
}

$idAnuncio = (int) $_GET['idAnuncio'];

// Busca anúncio
$buscarAnuncio = "
    SELECT *
    FROM Anuncios
    WHERE idAnuncio = $idAnuncio
";

$res = mysqli_query($conn, $buscarAnuncio)
    or die("Erro ao tentar buscar o anúncio!");

// Verifica se existe
if (mysqli_num_rows($res) == 0) {
    echo "
        <div class='container mt-5'>
            <div class='alert alert-danger text-center'>
                Anúncio não encontrado!
            </div>
        </div>
    ";
    include "footer.php";
    exit;
}

$anuncio = mysqli_fetch_assoc($res);

// 🔐 PERMISSÃO (DONO OU ADMIN)
if (
    $anuncio['Usuarios_idUsuario'] != $_SESSION['idUsuario'] &&
    $_SESSION['nivelUsuario'] != 'administrador'
) {
    echo "
        <div class='container mt-5'>
            <div class='alert alert-danger text-center'>
                Você não tem permissão para editar este anúncio!
            </div>
        </div>
    ";
    include "footer.php";
    exit;
}

// Dados do anúncio
$fotoAnuncio = $anuncio['fotoAnuncio'];
$tituloAnuncio = $anuncio['tituloAnuncio'];
$categoriaAnuncio = $anuncio['categoriaAnuncio'];
$descricaoAnuncio = $anuncio['descricaoAnuncio'];
$valorAnuncio = $anuncio['valorAnuncio'];
$statusAnuncio = $anuncio['statusAnuncio'];
?>

<!-- FORMULÁRIO -->
<section class="py-5" id="Anuncio">

    <div class="d-flex justify-content-center mb-3">
        <div class="row">
            <div class="col">

                <h2>Editar Anúncio:</h2>

                <form action="actionEditarAnuncio.php" method="POST" class="was-validated"
                    enctype="multipart/form-data">

                    <input type="hidden" name="idAnuncio" value="<?php echo $idAnuncio; ?>">
                    <input type="hidden" name="fotoAtual" value="<?php echo $fotoAnuncio; ?>">

                    <?php if (!empty($fotoAnuncio)) { ?>
                        <div class="mb-3 text-center">
                            <img src="<?php echo $fotoAnuncio; ?>" class="img-thumbnail" style="max-width:200px;">
                            <p class="mt-2">Foto atual do anúncio</p>
                        </div>
                    <?php } ?>

                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" name="fotoAnuncio">
                        <label>Nova foto do anúncio</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="tituloAnuncio"
                            value="<?php echo $tituloAnuncio; ?>" required>
                        <label>Título</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" name="categoriaAnuncio" required>
                            <option value="Camisetas" <?php if ($categoriaAnuncio == "Camisetas")
                                echo "selected"; ?>>
                                Camisetas</option>
                            <option value="Moletons" <?php if ($categoriaAnuncio == "Moletons")
                                echo "selected"; ?>>
                                Moletons</option>
                            <option value="Biblias" <?php if ($categoriaAnuncio == "Biblias")
                                echo "selected"; ?>>Bíblias
                            </option>
                            <option value="Bonés" <?php if ($categoriaAnuncio == "Bonés")
                                echo "selected"; ?>>Bonés
                            </option>
                            <option value="Canecas" <?php if ($categoriaAnuncio == "Canecas")
                                echo "selected"; ?>>Canecas
                            </option>
                            <option value="Outra" <?php if ($categoriaAnuncio == "Outra")
                                echo "selected"; ?>>Outra
                            </option>
                        </select>
                        <label>Categoria</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="descricaoAnuncio"
                            required><?php echo $descricaoAnuncio; ?></textarea>
                        <label>Descrição</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="valorAnuncio" value="<?php echo $valorAnuncio; ?>"
                            required>
                        <label>Valor</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" name="statusAnuncio" required>
                            <option value="disponivel" <?php if ($statusAnuncio == "disponivel")
                                echo "selected"; ?>>
                                Disponível</option>
                            <option value="finalizado" <?php if ($statusAnuncio == "finalizado")
                                echo "selected"; ?>>
                                Finalizado</option>
                        </select>
                        <label>Status</label>
                    </div>

                    <button type="submit" class="btn btn-outline-dark">
                        Salvar Alterações
                    </button>
                    <a href='index.php#Produtos' class='btn btn-secondary'>
                        <i class='bi bi-arrow-left'></i>
                        Cancelar
                    </a>

                </form>

            </div>
        </div>
    </div>

</section>

<?php include "footer.php"; ?>