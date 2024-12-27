<?php namespace App\Service;

session_start();

use Exception;
use mysqli;
use Ramsey\Uuid\Nonstandard\Uuid;
use App\Model\Reparation;
require '../Model/Reparation.php';

require_once __DIR__ . '/../../vendor/autoload.php';
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Decoders\Base64ImageDecoder;
use Intervention\Image\Typography\FontFactory;

class ServiceReparation
{
    private Logger $log;

    function __construct() {
        $this->log = new Logger('LogReparationDB');
        try {
            $this->log->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app_reparation.log', Level::Info));
        } catch (Exception $e) {
            echo "Error configurando el logger: " . $e->getMessage();
        }

    }

    function connect(): mysqli
    {
        $conn = null;
        $db_conf = parse_ini_file('../../cfg/db_config.ini', true) ["params_db_sql"];

        try {
            $conn = new mysqli($db_conf['host'], $db_conf['user'], $db_conf['pwd'], $db_conf['db_name']);
            $this->log->info("Connected successfully");
        } catch (Exception) {
            $this->log->error("Connection failed");
        }

        return $conn;
    }
    function disconnect($conn): void
    {
        $conn->close();
    }

    function getReparation($idReparation, $role): Reparation | null
    {
        $sql = "SELECT * FROM Workshop.Reparation WHERE idReparation = '" . $idReparation . "';";
        $conn = $this->connect();

        try {
            $result = $conn->query($sql);

            if ($result->num_rows <= 0) {
                $this->log->warning("FAILED to select reparation");
                return null;
            }

            $row = $result->fetch_assoc();

            $carPicture = $row['carPicture'];

            if ($role == 'client') {
                $carPicture = $this->addPixelate($carPicture);
            }

            $reparation = new Reparation(
                $row['idReparation'],
                $row['idWorkshop'],
                $row['nameWorkshop'],
                $row['registerDate'],
                $row['licensePlate'],
                $carPicture
            );

            $this->log->info("SELECT reparation successfully: " . $reparation->getIdReparation());
        } catch (Exception) {
            $this->log->warning("FAILED to select reparation");
            $reparation = null;
        }

        $this->disconnect($conn);
        return $reparation;
    }


    function insertReparation($idWorkshop, $nameWorkshop, $date, $licensePlate, $carPicture): Reparation | null
    {
        $idReparation = $this->generateUUID();
        //Create reparation
        $reparation = new Reparation(
            $idReparation,
            $idWorkshop,
            $nameWorkshop,
            $date,
            $licensePlate,
            $this->addWatermark($carPicture, $licensePlate, $idReparation)
        );

        $sql = "INSERT INTO Workshop.Reparation (
            idReparation, 
            idWorkshop, 
            nameWorkshop, 
            registerDate, 
            licensePlate,
            carPicture
            ) VALUES (
                '" . $reparation->getIdReparation() . "', 
                " . $reparation->getIdWorkshop() . ", 
                '" . $reparation->getNameWorkshop() . "', 
                '" . $reparation->getRegisterDate() . "', 
                '" . $reparation->getLicensePlate() . "',
                '" . $reparation->getCarPicture() . "'    
            );
        ";

        $conn = $this->connect();

        try {
            $conn->query($sql);
            $this->log->info("INSERT reparation successfully: " . $reparation->getIdReparation());
        } catch (Exception) {
            $this->log->error("FAILED to insert reparation: " . $reparation->getIdReparation());
            $reparation = null;
        }

        $this->disconnect($conn);
        return $reparation;
    }
    function generateUUID(): string
    {
        return Uuid::uuid4();
    }

    function addWatermark($carPicture, $licensePlate, $idReparation): string
    {
        $manager = new ImageManager(new Driver);
        $image = $manager->read($carPicture, Base64ImageDecoder::class);

        $image->text($licensePlate . ' - ' . $idReparation, 20, 50, function (FontFactory $font) {
            $font->file(__DIR__ . '/../../fonts/arial.ttf');
            $font->size(48);
            $font->color('#FAE500');
            $font->stroke('#000000', 9);
        });

        return base64_encode($image->encode());
    }

    function addPixelate($carPicture): string
    {
        $manager = new ImageManager(new Driver);
        $image = $manager->read($carPicture, Base64ImageDecoder::class);

        $image->pixelate(48);

        return base64_encode($image->encode());
    }
}