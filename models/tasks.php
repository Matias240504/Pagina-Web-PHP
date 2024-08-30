<?php
class Tasks {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTasks() {
        $stmt = $this->conn->prepare("SELECT t.*, u.usuario AS usuario_creador FROM tareas t INNER JOIN usuarios u ON t.id_usuario = u.id_usuario");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }
    

    public function getCompletedTasks() {
        $stmt = $this->conn->prepare("SELECT * FROM tareas WHERE estado_tarea = 'completada'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIncompletedTasks() {
        $stmt = $this->conn->prepare("SELECT * FROM tareas WHERE estado_tarea = 'pendiente'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTasksById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tareas WHERE id_tarea = :id_tarea");
        $stmt->bindParam('id_tarea', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addTasks($data) {
        $id_usuario = $_SESSION['user_id'];

        $stmt = $this->conn->prepare("INSERT INTO tareas (nombre_tarea, descripcion_tarea, id_usuario) VALUES (:nombre_tarea, :descripcion_tarea, :id_usuario)");
        $stmt->bindParam(':nombre_tarea', $data['nombre_tarea']);
        $stmt->bindParam(':descripcion_tarea', $data['descripcion_tarea']);
        $stmt->bindParam(':id_usuario', $id_usuario); 
        $stmt->execute();
    }
    

    public function updateTasks($data) {
        $stmt = $this->conn->prepare("UPDATE tareas SET nombre_tarea= :nombre_tarea, descripcion_tarea= :descripcion_tarea, estado_tarea = :estado_tarea WHERE id_tarea = :id_tarea");
        $stmt->bindParam(':id_tarea', $data['id_tarea']);
        $stmt->bindParam(':nombre_tarea', $data['nombre_tarea']);
        $stmt->bindParam(':descripcion_tarea', $data['descripcion_tarea']);
        $stmt->bindParam(':estado_tarea', $data['estado_tarea']);
        $stmt->execute();
    }

    public function deleteTasks($id) {
        $stmt = $this->conn->prepare("DELETE FROM tareas WHERE id_tarea = :id_tarea");
        $stmt->bindParam(':id_tarea', $id);
        $stmt->execute();
    }

    public function searchTasks($name) {
        $searchName = '%' . $name . '%';
        
        $stmt = $this->conn->prepare("SELECT     t.*, u.usuario AS usuario_creador 
            FROM tareas t 
            INNER JOIN usuarios u ON t.id_usuario = u.id_usuario 
            WHERE t.nombre_tarea LIKE :nombre_tarea
        ");
        $stmt->bindParam(':nombre_tarea', $searchName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveReport($id_usuario, $nombre_informe, $fecha, $estado_informe) {
        try {
            $sql = "INSERT INTO informes (id_usuario, nombre_informe, fecha, estado_informe) VALUES (:id_usuario, :nombre_informe, :fecha, :estado_informe)";
            echo "SQL: " . $sql . "<br>";
            echo "Params: id_usuario=$id_usuario, nombre_informe=$nombre_informe, fecha=$fecha, estado_informe=$estado_informe<br>";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':nombre_informe', $nombre_informe);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado_informe', $estado_informe);
            $stmt->execute();
            return true; 
        } catch (PDOException $e) {
            echo "Error al guardar el informe: " . $e->getMessage();
            return false;
        }
    }
}