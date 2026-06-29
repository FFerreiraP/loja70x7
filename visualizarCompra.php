<?php
include "header.php";
include "conexaoBD.php";

if (!isset($_GET['idCompra'])) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Compra não encontrada.</div></div>";
    include "footer.php";
    exit;
}

$idCompra = intval($_GET['idCompra']);

$sql = "
    SELECT
        compras.*,
        usuarios.nomeUsuario,
        usuarios.emailUsuario,
        usuarios.fotoUsuario,
        anuncios.tituloAnuncio,
        anuncios.descricaoAnuncio,
        anuncios.fotoAnuncio
    FROM compras
    INNER JOIN usuarios
        ON compras.Usuarios_idUsuario = usuarios.idUsuario
    INNER JOIN anuncios
        ON compras.Anuncios_idAnuncio = anuncios.idAnuncio
    WHERE compras.idCompra = $idCompra";

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) == 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Compra não encontrada.</div></div>";
    include "footer.php";
    exit;
}

$Compra = mysqli_fetch_assoc($res);
?>

<section class="py-5">

    <div class="container">

        <div class="row">

            <div class="col-md-5">

                <div class="card">

                    <img src="<?php echo $Compra['fotoAnuncio']; ?>" class="card-img-top">

                    <div class="card-body text-center">

                        <img src="<?php echo $Compra['fotoUsuario']; ?>" class="rounded-circle mb-3" width="120">

                        <h4><?php echo $Compra['nomeUsuario']; ?></h4>

                        <p><?php echo $Compra['emailUsuario']; ?></p>

                    </div>

                </div>

            </div>

            <div class="col-md-7">

                <div class="card">

                    <div class="card-header bg-primary text-white">

                        <h3>Detalhes da Compra</h3>

                    </div>

                    <div class="card-body">

                        <table class="table">

                            <tr>
                                <th>ID da Compra</th>
                                <td><?php echo $Compra['idCompra']; ?></td>
                            </tr>

                            <tr>
                                <th>Cliente</th>
                                <td><?php echo $Compra['nomeUsuario']; ?></td>
                            </tr>

                            <tr>
                                <th>Anúncio</th>
                                <td><?php echo $Compra['tituloAnuncio']; ?></td>
                            </tr>

                            <tr>
                                <th>Descrição</th>
                                <td><?php echo $Compra['descricaoAnuncio']; ?></td>
                            </tr>

                            <tr>
                                <th>Valor</th>
                                <td class="text-success fw-bold">
                                    R$ <?php echo number_format($Compra['valorCompra'], 2, ",", "."); ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Data</th>
                                <td><?php echo date("d/m/Y", strtotime($Compra['dataCompra'])); ?></td>
                            </tr>

                            <tr>
                                <th>Hora</th>
                                <td><?php echo substr($Compra['horaCompra'], 0, 5); ?></td>
                            </tr>

                        </table>

                        <a href="minhasCompras.php" class="btn btn-secondary">
                            Voltar
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include "footer.php"; ?>