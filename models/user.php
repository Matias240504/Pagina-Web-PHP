<?php 
class User {
    private $conn;

    public function __construct(){
        $databases = new Database();
        $db = $databases->dbConnection();
        $this ->conn = $db;
    }

    public function login($username, $password){
        $stmt  = $this -> conn -> prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(":usuario", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user["password"])) {
            $_SESSION ["user_id"] = $user["id_usuario"];
            return $user;
        }
        return false;
    }

    public function register($data){
        $stmt = $this->conn->prepare("INSERT INTO usuarios (usuario, password, nombre, apellidos, telefono) VALUES (:usuario, :password, :nombre, :apellidos, :telefono)");
        $stmt->bindParam(":usuario", $data["usuario"]);
        $stmt->bindParam(":password", password_hash($data["password"], PASSWORD_BCRYPT));
        $stmt->bindParam(":nombre", $data["nombre"]);
        $stmt->bindParam(":apellidos", $data["apellidos"]);
        $stmt->bindParam(":telefono", $data["telefono"]);
        $stmt->execute();
    }
    
    public function getUsers(){
        $stmt = $this -> conn -> prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}