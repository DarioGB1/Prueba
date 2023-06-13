<?php
//print_r($stmt->errorInfo());
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'db.php';

class registro_class extends Database {  
    private $table_name = "quejas";
    //public $id;
    //public $nombre;
    //public $descripcion;
    //public $fecha;
    //public $materia;
    //public $carrera;

    public function __construct(){    
        $this->conn = $this->getConnection();
    }

    public function getAllQuejas()
    {
        $stmt = $this->conn->prepare("
        SELECT
        `quejas`.`id` as 'queja_id', 
        `quejas`.`nombre` as 'queja_nombre',
        `quejas`.`descripcion` as 'queja_descripcion',
        `quejas`.`fecha` as 'queja_fecha',
        `quejas`.`materia` as 'queja_materia',
        `quejas`.`carrera` as 'queja_carrera'
        FROM `quejas`
        ORDER by `quejas`.`id` ASC
        ");

        if ($stmt->execute()) {
            $result = array();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $item = array(
                        'queja_id' => $row['queja_id'],
                        'queja_nombre' => $row['queja_nombre'],
                        'queja_descripcion' => $row['queja_descripcion'],
                        'queja_fecha' => $row['queja_fecha'],
                        'queja_materia' => $row['queja_materia'],
                        'queja_carrera' => $row['queja_carrera']
                    );
                    array_push($result , $item);
                }
            }

            return $result;
        } else {
            return false;
        }        
    }

    public function getQueja($queja_id, $nombre)
    {
        $where_clause = '';

        if (isset($queja_id)) {
            $where_clause = " WHERE `quejas`.`id`= $queja_id";
        }

        if (isset($nombre)) {
            $where_clause = " WHERE `quejas`.`nombre` = '$nombre'";
        }

        $stmt = $this->conn->prepare("
        SELECT
        `quejas`.`id` as 'queja_id', 
        `quejas`.`nombre` as 'queja_nombre',
        `quejas`.`descripcion` as 'queja_descripcion',
        `quejas`.`fecha` as 'queja_fecha',
        `quejas`.`materia` as 'queja_materia',
        `quejas`.`carrera` as 'queja_carrera'
        FROM `quejas`
        $where_clause
        ORDER by `quejas`.`id` ASC
        ");

        if ($stmt->execute()) {
            $result = array();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $item = array(
                        'queja_id' => $row['queja_id'],
                        'queja_nombre' => $row['queja_nombre'],
                        'queja_descripcion' => $row['queja_descripcion'],
                        'queja_fecha' => $row['queja_fecha'],
                        'queja_materia' => $row['queja_materia'],
                        'queja_carrera' => $row['queja_carrera']
                    );
                    array_push($result , $item);
                }
            }

            return $result;
        } else {
            return false;
        }        
    }
    
    public function insertQueja($nombre, $descripcion, $fecha, $materia, $carrera)
    {
        $stmt= $this->conn->prepare("INSERT INTO `quejas` (`id`, `nombre`, `descripcion`, `fecha`, `materia`, `carrera`) 
                                     VALUES (NULL, :nombre, :descripcion, :fecha, :materia, :carrera);") ;
        $stmt->bindValue('nombre', $nombre);
        $stmt->bindValue('descripcion', $descripcion);
        $stmt->bindValue('fecha', $fecha);
        $stmt->bindValue('materia', $materia);
        $stmt->bindValue('carrera', $carrera);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateQueja($id, $nombre, $descripcion, $fecha, $materia, $carrera)
    {
        $stmt = $this->conn->prepare("SELECT id FROM `quejas` WHERE `quejas`.`id` = :id;");
        $stmt->execute(array(':id' => $id));

        if ($stmt->rowCount()) {
            $stmt = $this->conn->prepare("
            UPDATE `quejas` SET 
            `nombre` = :nombre, 
            `descripcion` = :descripcion, 
            `fecha` = :fecha, 
            `materia` = :materia, 
            `carrera` = :carrera 
            WHERE `quejas`.`id` = :id;
            ");

            $stmt->bindValue('id', $id);
            $stmt->bindValue('nombre', $nombre);
            $stmt->bindValue('descripcion', $descripcion);
            $stmt->bindValue('fecha', $fecha);
            $stmt->bindValue('materia', $materia);
            $stmt->bindValue('carrera', $carrera);
           
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteQueja($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `quejas` WHERE `quejas`.`id` = :id");

        if ($stmt->execute(array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
}
?>
