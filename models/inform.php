<?php
class Inform {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getInform() {
        $stmt = $this->conn->prepare("SELECT t.*, u.usuario AS usuario_creador FROM informes t INNER JOIN usuarios u ON t.id_usuario = u.id_usuario");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }
}