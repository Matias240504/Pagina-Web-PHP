<?php include "views/partials/header.php"; ?>

<?php
if (isset($_SESSION['errors'])) {
    echo '<ul>';
    foreach ($_SESSION['errors'] as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul>';
    unset($_SESSION['errors']);
}
?>

<form action="index.php?action=register" method="post">
    <div class="box">
        <div class="container">
            <div class="top-header">
                <header>Registrarse</header>
            </div>

            <div class="input-field">
                <input type="text" name="usuario" id="usuario" class="input" placeholder="Ingrese Usuario" required>
                <i class="bx  bx-user"></i>
            </div>

            <div class="input-field">
                <input type="password" name="password" id="password" class="input" placeholder="Ingrese Contraseña" required>
                <i class="bx bx-lock-alt"></i>
            </div>
            
            <div class="input-field">
                <input type="password" name="repetir_password" id="repetir_password" class="input" placeholder="Repetir Contraseña" required>
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="input-field">
                <input type="text" name="nombre" id="nombre" class="input" placeholder="Ingrese su nombre" required>
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="input-field">
                <input type="text" name="apellidos" id="apellidos" class="input" placeholder="Ingrese su Apellido" required>
                <i class="bx bx-lock-alt"></i>
            </div>
            
            <div class="input-field">
                <input type="text" name="telefono" id="telefono" class="input" placeholder="Ingrese su Telefono" required>
                <i class="bx bx-lock-alt"></i>
            </div>

            <input type="submit" name="submit" class="submit" value="Registrarse">
        </div>
    </div>
</form>

<?php include "views/partials/footer.php"; ?>
