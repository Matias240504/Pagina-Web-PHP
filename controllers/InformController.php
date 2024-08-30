<?php
require_once 'config/config.php';
require_once 'models/inform.php';

class InformController {
    private $Inform;

    public function __construct() {
        $database = new Database();
        $this->Inform = new Inform($database->dbConnection());
    }

    public function viewInform() {
        $Informs = $this->Inform->getInform();
        $_SESSION['message'] = "Informes cargados correctamente.";
        require 'views/inform/viewinform.php';
    }
}