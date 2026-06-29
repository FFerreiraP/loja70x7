<?php include "header.php" ?>

<?php include "conexaoBD.php" ?>

<?php

//Recebe o valor do filtro via método GET
$filtroUsuario = $_GET['nivelUsuario'] ?? 'todos';

//Query para para consulta SQL a ser realizada
if ($filtroUsuario == 'todos') {
    $listarUsuarios = "SELECT * FROM Usuarios";
} else {
    $listarUsuarios = "SELECT * FROM Usuarios WHERE nivelUsuario = '$filtroUsuario' ";
}

//Executa a query para consulta no BD
$res = mysqli_query($conn, $listarUsuarios);

?>

<style>
    /* Remove sublinhado dos links e manter a cor padrão */
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    /* Aplica um efeito suave no hover do card */
    .card-hover {
        position: relative;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    /* Efeito ao passar o mouse */
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Camada escura que aparece no hover (overlay) */
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Torna o overlay visível no hover */
    .card-hover:hover .card-overlay {
        opacity: 1;
    }

    /*Faixa de Usuario finalizado*/
    .faixa-finalizado {
        right: 0;
        position: absolute;
        width: 50%;
        background: #dc3545;
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 0.7rem;
        padding: 5px 0;
        z-index: 10;
        box-shadow 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    /*Deixa a imagem em preto e branco*/
    .imagem-finalizada {
        filter: grayscale(100%);
        opacity: 0.8;
    }
</style>


<section class="py-5" id="Usuarios">

    <div class="container px-4 px-lg-5 mt-5">

        <!-- Formulário para Filtrar os Usuarios -->
        <form method="get" class="mb-5" action="listarUsuarios.php#Usuarios">
            <div class="row justify-content-center">
                <div class="col-md-4">

                    <select name="nivelUsuario" class="form-select">

                        <option value="todos" <?php if ($filtroUsuario == 'todos') {
                            echo "selected";
                        } ?>>Exibir todos
                        </option>
                        <option value="usuario" <?php if ($filtroUsuario == 'usuario') {
                            echo "selected";
                        } ?>>Exibir apenas
                            Usuarios </option>
                        <option value="administrador" <?php if ($filtroUsuario == 'administrador') {
                            echo "selected";
                        } ?>>
                            Exibir apenas Administradores</option>

                    </select>

                    <button href="listarUsuarios.php#Usuarios" type="submit" class="btn btn-outline-dark mt-3"
                        style="float:right"><i class="bi bi-funnel"></i>
                        Filtrar Usuarios
                    </button>

                </div>
            </div>
        </form>

        <?php
        $totalUsuarios = mysqli_num_rows($res);
        echo "<div class='alert alert-info text-center'>Há <strong>$totalUsuarios</strong> Usuarios em nosso sistema!</div>";
        ?>



        <!-- GRID DE CARDS -->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php

            //Verifica se a consulta retornou resultados
            if (mysqli_num_rows($res) > 0) {

                //Enquanto houver Usuarios, exibirá os cards
                while ($Usuario = mysqli_fetch_assoc($res)) {

                    ?>

                    <div class="col mb-5">

                        <!-- Link que torna todo o card clicável -->
                        <a class="card-link" href="visualizarUsuario.php?idUsuario=<?php echo $Usuario['idUsuario']; ?>">
                            <div class="card h-100 card-hover">

                                <?php
                                if ($Usuario['nivelUsuario'] == 'administrador') {
                                    echo "<div class='faixa-finalizado'>ADMINISTRADOR</div>";
                                }
                                ?>

                                <!-- Overlay exibido ao passar o mouse -->
                                <div class="card-overlay">
                                    <i class="bi bi-eye me-2"></i> Visualizar Usuario
                                </div>

                                <!-- Imagem do Usuario -->
                                <img class="card-img-top <?php if ($Usuario['nivelUsuario'] == 'administrador') {
                                    echo 'imagem-finalizada';
                                } ?>"
                                    src="<?php echo htmlspecialchars($Usuario['fotoUsuario']) ?>"
                                    style="height:200px;object-fit:cover;"
                                    alt="<?php echo htmlspecialchars($Usuario['nomeUsuario']) ?>" />

                                <!-- Conteúdo do card -->
                                <div class="card-body p-4">
                                    <div class="text-center">

                                        <!-- Título do Usuario -->
                                        <h5 class="fw-bolder">
                                            <?php echo htmlspecialchars($Usuario['nomeUsuario']) ?>
                                        </h5>


                                        <p>
                                            <?php echo htmlspecialchars($Usuario['emailUsuario']) ?>
                                        </p>

                                    </div>
                                </div>


                            </div>
                        </a>

                    </div>

                    <?php
                } //Fechamento do while que varre o array de Usuarios
            
            } //Fechamento do if
            else {
                //Caso não existam Usuarios
                echo "<div class='alert alert-info text-center'>Nenhum Usuario encontrado.</div>";
            }
            ?>
        </div>

    </div>

</section>

<?php include "footer.php" ?>