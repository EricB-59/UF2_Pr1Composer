<?php namespace App\Model;

class Reparation
{
    private $idReparation;
    private $idWorkshop;
    private $registerDate;
    private $licensePlate;

    function __construct($idReparation, $idWorkshop, $registerDate, $licensePlate)
    {
        $this->idReparation = $idReparation;
        $this->idWorkshop = $idWorkshop;
        $this->registerDate = $registerDate;
        $this->licensePlate = $licensePlate;
    }

    /**
     * @return string
     */
    public function getIdReparation()
    {
        return $this->idReparation;
    }

    /**
     * @param mixed $idReparation
     */
    public function setIdReparation($idReparation): void
    {
        $this->idReparation = $idReparation;
    }

    /**
     * @return mixed
     */
    public function getIdWorkshop()
    {
        return $this->idWorkshop;
    }

    /**
     * @param mixed $idWorkshop
     */
    public function setIdWorkshop($idWorkshop): void
    {
        $this->idWorkshop = $idWorkshop;
    }

    /**
     * @return mixed
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * @param mixed $registerDate
     */
    public function setRegisterDate($registerDate): void
    {
        $this->registerDate = $registerDate;
    }

    /**
     * @return mixed
     */
    public function getLicensePlate()
    {
        return $this->licensePlate;
    }

    /**
     * @param mixed $licensePlate
     */
    public function setLicensePlate($licensePlate): void
    {
        $this->licensePlate = $licensePlate;
    }
}