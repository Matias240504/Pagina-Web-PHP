<?php include 'views/partials/header.php'; ?>
<main>
    <h2>Informes Registrados</h2>
    <form method="POST" action="index.php?action=viewInform">
        <label for="usuario">Buscar Informe por Usuario: </label>
        <input type="text" name="usuario" id="usuario">
        <button type="submit">Buscar</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario Creador</th>
                <th>Nombre Informe</th>
                <th>Fecha</th>
                <th>Estado Informe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Informs as $Inform) : ?>
                <tr>    
                    <td><?= $Inform['id_informes'] ?></td>
                    <td><?= $Inform['usuario_creador'] ?></td>
                    <td><?= $Inform['nombre_informe'] ?></td>
                    <td><?= $Inform['fecha'] ?></td>
                    <td><?= $Inform['estado_informe'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include 'views/partials/footer.php'; ?>