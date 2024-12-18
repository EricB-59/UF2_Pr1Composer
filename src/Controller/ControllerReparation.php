<?php namespace App\Controller;

use App\Service\ServiceReparation;
use App\View\ViewReparation;

require '../Service/ServiceReparation.php';

$controller = new ControllerReparation;
if (isset($_POST["getReparation"])) $controller->getReparation();
if (isset($_POST["insertReparation"])) $controller->insertReparation($_POST['idWorkshop'], $_POST['date'], $_POST['licensePlate']);

class ControllerReparation
{
    function insertReparation($idWorkshop, $date, $licensePlate)
    {

    }
    function getReparation(): void
    {
        $role = $_SESSION['role'];
        $idReparation = $_POST['idReparation'];

        $service = new ServiceReparation();
        $reparation = $service->getReparation($role, $idReparation);

        $view = new ViewReparation();
        $view->render($reparation);
    }
}