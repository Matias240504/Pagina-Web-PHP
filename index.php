<?php 
session_start();

require_once "config/config.php";
require_once "controllers/TaskController.php";
require_once "controllers/UserController.php";
require_once "controllers/InformController.php";

$action = isset($_GET["action"]) ? $_GET["action"] :"";

switch ($action) {
    case 'manageTasks':
        if (isset($_COOKIE["user"])) {
            $controller = new TaskController();
            $controller -> manageTasks();
        } else {
            header("location: index.php?action=login");
        }
        break;

    case "generateReportIncomplete":
        if (isset($_COOKIE["user"])) {
            $controller = new TaskController();
            $controller -> generateReportIncomplete();
        } else {
            header("location: index.php?action=login");
        }
        break;

    case "generateReportComplete":
        if (isset($_COOKIE["user"])) {
            $controller = new TaskController();
            $controller -> generateReportComplete();
        } else {
            header("location: index.php?action=login");
        }
        break;

    case "viewUsers":
        if (isset($_COOKIE["user"])) {
            $controller = new UserController();
            $controller -> viewUsers();
        } else {
            header("Location: index.php?action=login");
        }
        break;

    case "viewInform":
        if (isset($_COOKIE["user"])) {
            $controller = new InformController();
            $controller -> viewInform();
        } else {
            header("Location: index.php?action=login");
        }
        break;

    case "login":
        $controller = new UserController();
        $controller -> login();
        break;

    case "register":
        $controller = new UserController();
        $controller -> register();
        break;

    case "logout":
        if (isset($_COOKIE["user"])) {
            $controller = new UserController();
            $controller -> logout();
        } else {
            header("Location: index.php?action=login");
        }
        break;

    case "editTasks":
        if (isset($_COOKIE["user"])) {
            $controller = new TaskController();
            $controller -> editTasks();
        } else {
            header("Location: index.php?action=login");
        }
        break;

    case "home":
    default:
        if (isset($_COOKIE["user"])) {
            require "views/home.php";
        } else {
            header("Location: index.php?action=login");
        }
        break;
}