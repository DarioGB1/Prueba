<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");
include_once 'class_registro.php';

$queja = new registro_class();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': // get a single or list

        if (isset($_GET['id'])) {
            $getId = $queja->getQueja($_GET['id'],null);
            if (is_array($getId)) {
                $result["data"] = $getId;
                $result["status"] = 'success';
            } else {
                $result["status"] = "error";
                $result["message"] = "Unable to communicate with the database";
            }
        } else {
            $getAll = $queja->getAllQuejas();
            if (is_array($getAll)) {
                $result["data"] = $getAll;
                $result["status"] = 'success';
            } else {
                $result["status"] = "error";
                $result["message"] = "Unable to communicate with the database";
            }
        }
        break;

    case 'POST': // create
        $_POST = json_decode(file_get_contents('php://input'), true);
        if ($queja->insertQueja($_POST['nombre'], $_POST['descripcion'], $_POST['fecha'], $_POST['materia'], $_POST['carrera'])) {
            $result["status"] = 'success';
            $result["data"] = null;
        } else {
            $result["status"] = 'error';
            $result["message"] = "Duplicate data or invalid data";
        }
        break;

    case 'DELETE': // delete
        $_DELETE = json_decode(file_get_contents('php://input'), true);
        $deleteId = $queja->deleteQueja($_DELETE['id']);
        if ($deleteId) {
            $result["data"] = null;
            $result["status"] = 'success';
        } else {
            $result["status"] = "error";
            $result["message"] = "Unable to communicate with the database";
        }
        break;

    case 'PUT': // update
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $updateId = $queja->updateQueja($_PUT['id'], $_PUT['nombre'], $_PUT['descripcion'], $_PUT['fecha'], $_PUT['materia'], $_PUT['carrera']);
        if ($updateId) {
            $result["data"] = null;
            $result["status"] = 'success';
        } else {
            $result["status"] = "error";
            $result["message"] = "Unable to communicate with the database or duplicate";
        }
        break;

    default:
        {
            $result["status"] = "error";
            $result["message"] = "Unknown request";
        }
}
echo json_encode($result);
?>
