<?php include "views/partials/header.php"; ?>

<form action="index.php?action=login" method="post">
    <div class="box">
        <div class="container">
            <div class="top-header">
                <header>Iniciar Sesion</header>
            </div>

            <div class="input-field">
                <input type="text" name="usuario" id="usuario" class="input" placeholder="Usuario" required>
                <i class="bx  bx-user"></i>
            </div>

            <div class="input-field">
                <input type="password" name="password" id="password" class="input" placeholder="Contraseña" required>
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="input-field">
                <input type="submit" class="submit" value="Inicio">
            </div>

            <div class="button">
                <div class="right">
                    <p>¿No tienes cuenta? <a href="index.php?action=register">Registrate Aqui</a></p>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include "views/partials/footer.php";?>