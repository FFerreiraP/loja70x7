<?php include "header.php"; ?>
<?php include "conexaoBD.php"; ?>

<?php

$idUsuario = $_SESSION['idUsuario'];

$listarCompras = "
SELECT
    compras.*,
    usuarios.nomeUsuario,
    usuarios.fotoUsuario,
    anuncios.tituloAnuncio
FROM compras
INNER JOIN usuarios
    ON compras.Usuarios_idUsuario = usuarios.idUsuario
INNER JOIN anuncios
    ON compras.Anuncios_idAnuncio = anuncios.idAnuncio
WHERE compras.Usuarios_idUsuario = $idUsuario
ORDER BY compras.idCompra DESC";

$res = mysqli_query($conn, $listarCompras);

?>

<style>
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .card-hover {
        position: relative;
        transition: transform .2s ease, box-shadow .2s ease;
        cursor: pointer;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .2);
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        opacity: 0;
        transition: opacity .3s ease;
    }

    .card-hover:hover .card-overlay {
        opacity: 1;
    }
</style>

<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <?php
        $totalCompras = mysqli_num_rows($res);
        ?>

        <div class="alert alert-info text-center">
            Há <strong><?php echo $totalCompras; ?></strong> compras cadastradas!
        </div>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php

            if (mysqli_num_rows($res) > 0) {

                while ($Compra = mysqli_fetch_assoc($res)) {

                    ?>

                    <div class="col mb-5">

                        <a class="card-link" href="visualizarCompra.php?idCompra=<?php echo $Compra['idCompra']; ?>">

                            <div class="card h-100 card-hover">

                                <div class="card-overlay">
                                    <i class="bi bi-eye me-2"></i>
                                    Visualizar Compra
                                </div>

                                <img class="card-img-top" src="<?php echo htmlspecialchars($Compra['fotoUsuario']); ?>"
                                    alt="<?php echo htmlspecialchars($Compra['nomeUsuario']); ?>">

                                <div class="card-body p-4">

                                    <div class="text-center">

                                        <h5 class="fw-bolder">
                                            Compra #<?php echo $Compra['idCompra']; ?>
                                        </h5>

                                        <p>
                                            <strong>Cliente:</strong><br>
                                            <?php echo htmlspecialchars($Compra['nomeUsuario']); ?>
                                        </p>

                                        <p>
                                            <strong>Anúncio:</strong><br>
                                            <?php echo htmlspecialchars($Compra['tituloAnuncio']); ?>
                                        </p>

                                        <p>
                                            <strong>Data:</strong><br>
                                            <?php echo date('d/m/Y', strtotime($Compra['dataCompra'])); ?>
                                        </p>

                                        <p>
                                            <strong>Hora:</strong><br>
                                            <?php echo substr($Compra['horaCompra'], 0, 5); ?>
                                        </p>

                                        <h5 class="text-success">
                                            R$ <?php echo number_format($Compra['valorCompra'], 2, ',', '.'); ?>
                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>

                    <?php

                }

            } else {

                echo "<div class='alert alert-warning text-center'>Nenhuma compra encontrada.</div>";

            }

            ?>

        </div>

    </div>

</section>

<?php include "footer.php"; ?>