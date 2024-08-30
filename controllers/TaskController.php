<?php
require_once 'config/config.php';
require_once 'models/tasks.php';

class TaskController {
    private $Task;

    public function __construct() {
        $database = new Database();
        $this->Task = new Tasks($database->dbConnection());
    }

    public function manageTasks() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            if ($action === 'add') {
                $this->Task->addTasks($_POST);
                $_SESSION['message'] = "Tarea agregada correctamente.";
            } elseif ($action === 'update') {
                $this->Task->updateTasks($_POST);
                $_SESSION['message'] = "Tarea actualizada correctamente.";
            } elseif ($action === 'delete') {
                $this->Task->deleteTasks($_POST['id_tarea']);
                $_SESSION['message'] = "Tarea eliminada correctamente.";
            } elseif ($action === 'search') {
                $Tasks = $this->Task->searchTasks($_POST['nombre_tarea']);
                $_SESSION['message'] = "Busqueda realizada.";
                require 'views/tasks/manage.php';
                return;
            }
        }
        $Tasks = $this->Task->getTasks();
        require 'views/tasks/manage.php';
    }

    public function editTasks() {
        $Task = $this->Task->getTasksById($_GET['id']);
        require 'views/tasks/edit.php';
    }

    public function generateReportIncomplete() {
        $Tasks = $this->Task->getIncompletedTasks();
    
        require 'vendor/autoload.php';
    
        date_default_timezone_set('America/Lima'); 
        $date = date('Y-m-d H:i:s');

        $html = '<html>
        <head>
            <style>
                body { font-family: DejaVu Sans, sans-serif; }
                h1 { text-align: center; }
                p { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .footer { position: fixed; bottom: 0; width: 100%; text-align: center; }
            </style>
        </head>
        <body>
            <h1>Reporte de Tareas Incompletas</h1>
            <p>Generado el: ' . $date . '</p>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($Tasks as $Task) {
            $html .= '<tr>
                <td>' . htmlspecialchars($Task['nombre_tarea']) . '</td>
                <td>' . htmlspecialchars($Task['descripcion_tarea']) . '</td>
                <td>' . htmlspecialchars($Task['estado_tarea']) . '</td>
            </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
            <div class="footer">
                <p>&copy; ' . date('Y') . ' WebMat</p>
            </div>
        </body>
        </html>';
    
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); 
        $dompdf->render();
    
        $filename = 'reporte_tareas_incompletas_' . date('Y-m-d_H-i-s') . '.pdf';
        $dompdf->stream($filename);

        $estado_informe = 'incomplete';
        $nombre_informe = 'reporte_tareas_incompletas_' . date('Y-m-d_H-i-s');
        $id_usuario = $_SESSION['user_id']; 
        $this->Task->saveReport($id_usuario, $nombre_informe, $date, $estado_informe);
    
        $_SESSION['message'] = "Reporte generado correctamente.";
    }
    
    
    public function generateReportComplete() {
        $Tasks = $this->Task->getCompletedTasks();
        require 'vendor/autoload.php';
    
        date_default_timezone_set('America/Lima'); 
        $date = date('Y-m-d H:i:s');
    
        $html = '<html>
        <head>
            <style>
                body { font-family: DejaVu Sans, sans-serif; }
                h1 { text-align: center; }
                p { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .footer { position: fixed; bottom: 0; width: 100%; text-align: center; }
            </style>
        </head>
        <body>
            <h1>Reporte de Tareas Completas</h1>
            <p>Generado el: ' . $date . '</p>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($Tasks as $Task) {
            $html .= '<tr>
                <td>' . htmlspecialchars($Task['nombre_tarea']) . '</td>
                <td>' . htmlspecialchars($Task['descripcion_tarea']) . '</td>
                <td>' . htmlspecialchars($Task['estado_tarea']) . '</td>
            </tr>';
        }
    
        $html .= '
                </tbody>
            </table>
            <div class="footer">
                <p>&copy; ' . date('Y') . ' WebMat</p>
            </div>
        </body>
        </html>';
    
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); 
        $dompdf->render();
    
        $filename = 'reporte_tareas_completas_' . date('Y-m-d_H-i-s') . '.pdf';
        $dompdf->stream($filename);

        $estado_informe = 'completed';
        $nombre_informe = 'reporte_tareas_completas_' . date('Y-m-d_H-i-s');
        $id_usuario = $_SESSION['user_id']; 
        $this->Task->saveReport($id_usuario, $nombre_informe, $date, $estado_informe);
    
        $_SESSION['message'] = "Reporte generado correctamente.";
    }      
}