<?php include 'views/partials/header.php'; ?>

<h2>Editar Tarea</h2>

<form method="POST" action="index.php?action=manageTasks">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id_tarea" value="<?= $Task['id_tarea'] ?>">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre_tarea" id="nombre_tarea" value="<?= $Task['nombre_tarea'] ?>" required>
    
    <label for="descripcion">Descripcion:</label>
    <input type="text" name="descripcion_tarea" id="descripcion_tarea" value="<?= $Task['descripcion_tarea'] ?>" required>
    
    <label for="estado_tarea">Estado:</label>
    <select name="estado_tarea" id="estado_tarea" required>
        <option value="pendiente" <?= $Task['estado_tarea'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
        <option value="en_progreso" <?= $Task['estado_tarea'] == 'en_progreso' ? 'selected' : '' ?>>En Progreso</option>
        <option value="completada" <?= $Task['estado_tarea'] == 'completada' ? 'selected' : '' ?>>Completada</option>
    </select>
    
    <button type="submit">Actualizar Tarea</button>
</form>

<?php include 'views/partials/footer.php'; ?>
