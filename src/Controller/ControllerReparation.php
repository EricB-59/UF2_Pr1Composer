<?php namespace App\Controller;
session_start();

use App\Service\ServiceReparation;
use App\View\ViewReparation;

if (isset($_POST['getReparation'])) {
    $controller = new ControllerReparation();
    $controller->getReparation();
}
if (isset($_POST['insertReparation'])) {
    $controller = new ControllerReparation();
    $controller->insertReparation();
}

class ControllerReparation
{
    public function getReparation(): void
    {
        require_once '../Service/ServiceReparation.php';
        $service = new ServiceReparation();
        $reparation = $service->getReparation($_POST['idReparation']);
        $this->updateRender($reparation);
    }
    public function insertReparation(): void
    {
        require_once '../Service/ServiceReparation.php';
        $service = new ServiceReparation();
        $reparation = $service->insertReparation(
            $_POST['idWorkshop'],
            $_POST['nameWorkshop'],
            $_POST['date'],
            $_POST['licensePlate'],
        );
        $this->updateRender($reparation);
    }

    function updateRender($reparation): void
    {
        require_once '../View/ViewReparation.php';
        $view = new ViewReparation();
        $view->render($reparation);
    }
}
