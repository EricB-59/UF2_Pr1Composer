<?php namespace App\Model;

class Reparation
{
    private string $idReparation;
    private mixed $idWorkshop;
    private mixed $nameWorkshop;
    private mixed $registerDate;
    private mixed $licensePlate;
    private mixed $carPicture;

    function __construct($idReparation, $idWorkshop, $nameWorkshop,$registerDate, $licensePlate, $carPicture)
    {
        $this->idReparation = $idReparation;
        $this->idWorkshop = $idWorkshop;
        $this->nameWorkshop = $nameWorkshop;
        $this->registerDate = $registerDate;
        $this->licensePlate = $licensePlate;
        $this->carPicture = $carPicture;
    }

    public function getIdReparation(): string
    {
        return $this->idReparation;
    }

    public function getIdWorkshop(): mixed
    {
        return $this->idWorkshop;
    }

    public function getNameWorkshop(): mixed
    {
        return $this->nameWorkshop;
    }

    public function getRegisterDate(): mixed
    {
        return $this->registerDate;
    }

    public function getLicensePlate(): mixed
    {
        return $this->licensePlate;
    }

    public function getCarPicture()
    {
        return $this->carPicture;
    }
}