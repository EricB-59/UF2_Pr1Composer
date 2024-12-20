<?php namespace App\Model;

class Reparation
{
    private $idReparation;
    private $idWorkshop;
    private $nameWorkshop;
    private $registerDate;
    private $licensePlate;

    function __construct($idReparation, $idWorkshop, $nameWorkshop,$registerDate, $licensePlate)
    {
        $this->idReparation = $idReparation;
        $this->idWorkshop = $idWorkshop;
        $this->nameWorkshop = $nameWorkshop;
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
     * @return mixed
     */
    public function getIdWorkshop()
    {
        return $this->idWorkshop;
    }

    /**
     * @return mixed
     */
    public function getNameWorkshop()
    {
        return $this->nameWorkshop;
    }

    /**
     * @return mixed
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }


    /**
     * @return mixed
     */
    public function getLicensePlate()
    {
        return $this->licensePlate;
    }
}