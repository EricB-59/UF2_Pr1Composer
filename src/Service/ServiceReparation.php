<?php namespace App\Service;

use mysqli;
use App\Model\Reparation;
require '../Model/Reparation.php';

class ServiceReparation
{
    function connect()
    {
        $db_conf = parse_ini_file('../../cfg/db_config.ini', true) ["params_db_sql"];
        $conn = new mysqli($db_conf['host'], $db_conf['user'], $db_conf['pwd'], $db_conf['db_name']);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    function insertReparation()
    {

    }
    function getReparation($role, $idReparation): Reparation | null
    {
        $sql = 'SELECT * FROM Workshop.Reparation WHERE idReparation = '.$idReparation.';';
        $conn = $this->connect();
        $result = $conn->query($sql);

        if ($result->num_rows <= 0) return null;

        $row = $result->fetch_assoc();

        return new Reparation($row['idReparation'], $row['idWorkshop'], $row['registerDate'], $row['licensePlate']);
    }
}