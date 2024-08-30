<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatWeb</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1> Mat Web </h1>
    </header>
    <?php if (isset($_COOKIE["user"])): ?>
        <nav>
            <ul>
                <li><a href="index.php?action=home">Inicio</a></li>
                <li><a href="index.php?action=manageTasks">Gestion de Tareas</a></li>
                <li><a href="index.php?action=generateReportComplete">Reporte de Tareas Completadas</a></li>
                <li><a href="index.php?action=generateReportIncomplete">Reporte de Tareas Imcompletas</a></li>
                <li><a href="index.php?action=viewUsers">Usuarios Registrados</a></li>
                <li><a href="index.php?action=viewInform">Informes Creados</a></li>
                <li><a href="index.php?action=logout">Cerrar Sesion</a></li>
            </ul>       
        </nav>
        <?php endif;?>
        <?php if (isset($_SESSION["message"])): ?>
            <div class="message">
                <p><?php echo $_SESSION["message"]; unset($_SESSION["message"]);?></p>
            </div>
        <?php endif;?>
</body>