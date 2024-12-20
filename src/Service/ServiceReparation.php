<?php namespace App\Service;

use mysqli;
use Ramsey\Uuid\Nonstandard\Uuid;
use App\Model\Reparation;

require_once __DIR__ . '/../../vendor/autoload.php';

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
    function disconnect($conn): void { $conn->close(); }

    function getReparation($idReparation): Reparation | null
    {
        $sql = "SELECT * FROM Workshop.Reparation WHERE idReparation = '" . $idReparation . "';";
        $conn = $this->connect();
        $result = $conn->query($sql);

        if ($result->num_rows <= 0) return null;

        $row = $result->fetch_assoc();

        $this->disconnect($conn);

        return new Reparation($row['idReparation'], $row['idWorkshop'], $row['nameWorkshop'],$row['registerDate'], $row['licensePlate']);
    }


    function insertReparation($idWorkshop, $nameWorkshop, $date, $licensePlate): Reparation | null
    {
        //Create reparation
        $reparation = new Reparation(
            $this->generateUUID(),
            $idWorkshop,
            $nameWorkshop,
            $date,
            $licensePlate
        );

        $sql = "INSERT INTO Workshop.Reparation (
            idReparation, 
            idWorkshop, 
            nameWorkshop, 
            registerDate, 
            licensePlate
            ) VALUES (
                '" . $reparation->getIdReparation() . "', 
                " . $reparation->getIdWorkshop() . ", 
                '" . $reparation->getNameWorkshop() . "', 
                '" . $reparation->getRegisterDate() . "', 
                '" . $reparation->getLicensePlate() . "'
            );
        ";

        $conn = $this->connect();
        $conn->query($sql);
        $this->disconnect($conn);

        return $reparation;
    }
    function generateUUID(): string
    {
        return Uuid::uuid4();
    }


}