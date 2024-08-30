<?php include 'views/partials/header.php'; ?>
<main>
    <h2>Usuarios Registrados</h2>
    <form method="POST" action="index.php?action=viewUsers">
        <label for="usuario">Buscar por Usuario: </label>
        <input type="text" name="usuario" id="usuario">
        <button type="submit">Buscar</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id_usuario'] ?></td>
                    <td><?= $user['usuario'] ?></td>
                    <td><?= $user['nombre'] ?></td>
                    <td><?= $user['apellidos'] ?></td>
                    <td><?= $user['telefono'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include 'views/partials/footer.php'; ?>