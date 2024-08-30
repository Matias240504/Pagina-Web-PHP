<?php
require_once 'config/config.php';
require_once 'models/user.php';

class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->user->login($_POST['usuario'], $_POST['password']);

            if ($user) {
                $_SESSION['user_id'] = $user['id_usuario'];
                setcookie('user', $user['id_usuario'], time() + (86400 * 30), "/");
                $_SESSION['message'] = "Inicio de sesión exitoso.";
                header('Location: index.php?action=home');
                exit();
            } else {
                $_SESSION['message'] = "Usuario o contraseña incorrectos.";
            }
        }
        require 'views/user/login.php';
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $repetir_password = $_POST['repetir_password'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $telefono = $_POST['telefono'];
    
            $errors = [];

            if ($password !== $repetir_password) {
                $errors[] = "Las contraseñas no coinciden.";
            }
    
            if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
                $errors[] = "El nombre solo puede contener letras.";
            }
    
            if (!preg_match("/^[a-zA-Z\s]+$/", $apellidos)) {
                $errors[] = "Los apellidos solo pueden contener letras.";
            }
    
            if (!preg_match("/^\+?\d+$/", $telefono)) {
                $errors[] = "El teléfono solo puede contener números.";
            }
    
            if (empty($errors)) {
                $this->user->register($_POST);
                $_SESSION['message'] = "Registro exitoso. Por favor, inicie sesión.";
                header('Location: index.php?action=login');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
            }
        }
        require 'views/user/register.php';
    }
    
    public function viewUsers() {
        $users = $this->user->getUsers();
        $_SESSION['message'] = "Usuarios cargados correctamente.";
        require 'views/user/users.php';
    }

    public function logout() {
        setcookie('user', '', time() - 3600, "/");
        header('Location: index.php?action=login');
        exit();
    }
}