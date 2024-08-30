<?php include 'views/partials/header.php'; ?>

<main>
    <h2>Gestión de Tareas</h2>
    <form method="POST" action="index.php?action=manageTasks">
        <input type="hidden" name="action" value="add">
        <label for="nombre">Nombre de la Tarea:</label>
        <input type="text" name="nombre_tarea" id="nombre_tarea" required>
        <label for="precio">Descripcion:</label>
        <input type="text" name="descripcion_tarea" id="descripcion_tarea" required>

        <button type="submit">Agregar Tarea</button>
    </form>
    
    <form method="POST" action="index.php?action=manageTasks">
        <input type="hidden" name="action" value="search">
        <label for="buscar">Buscar Tarea (Nombre):</label>
        <input type="text" name="nombre_tarea" id="buscar" >
        <button type="submit">Buscar</button>
    </form>
    
    <h3>Lista de Tareas</h3>
    
    <table> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario Creador</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Tasks as $Task): ?>
                <tr>
                    <td><?= $Task['id_tarea']?></td>
                    <td><?= $Task['usuario_creador']?></td>
                    <td><?= $Task['nombre_tarea']?></td>
                    <td><?= $Task['descripcion_tarea']?></td>
                    <td><?= $Task['estado_tarea']?></td>
                    <td>
                        <div class="button-group">
                            <form method="POST" action="index.php?action=manageTasks" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id_tarea" value="<?= $Task['id_tarea']?>">
                                <button type="submit" class="button-link">Eliminar</button>
                            </form>
                            <a class="button-link" href="index.php?action=editTasks&id=<?= $Task['id_tarea']?>">Editar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include 'views/partials/footer.php'; ?>
