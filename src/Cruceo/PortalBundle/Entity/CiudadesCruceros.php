<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\CiudadesCruceros
 *
 * @ORM\Table(name="ciudades_cruceros")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CiudadesCruceros
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var time $horaLlegada
     *
     * @ORM\Column(name="hora_llegada", type="time", nullable=true)
     */
    private $horaLlegada;

    /**
     * @var time $horaSalida
     *
     * @ORM\Column(name="hora_salida", type="time", nullable=true)
     */
    private $horaSalida;

    /**
     * @var integer $diaCrucero
     *
     * @ORM\Column(name="dia_crucero", type="integer", nullable=true)
     */
    private $diaCrucero;

    /**
     * @var Ciudades
     *
     * @ORM\ManyToOne(targetEntity="Ciudades", inversedBy="ciudadesCruceros")
     * @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     */
    private $ciudad;

    /**
     * @var Cruceros
     *
     * @ORM\ManyToOne(targetEntity="Cruceros", inversedBy="ciudadesCruceros")
     * @ORM\JoinColumn(name="crucero_id", referencedColumnName="id")
     */
    private $crucero;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set horaLlegada
     *
     * @param time $horaLlegada
     */
    public function setHoraLlegada($horaLlegada)
    {
        $this->horaLlegada = $horaLlegada;
    }

    /**
     * Get horaLlegada
     *
     * @return time 
     */
    public function getHoraLlegada()
    {
        return $this->horaLlegada;
    }

    /**
     * Set horaSalida
     *
     * @param time $horaSalida
     */
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;
    }

    /**
     * Get horaSalida
     *
     * @return time 
     */
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }

    /**
     * Set diaCrucero
     *
     * @param integer $diaCrucero
     */
    public function setDiaCrucero($diaCrucero)
    {
        $this->diaCrucero = $diaCrucero;
    }

    /**
     * Get diaCrucero
     *
     * @return integer 
     */
    public function getDiaCrucero()
    {
        return $this->diaCrucero;
    }

    /**
     * Set ciudad
     *
     * @param Cruceo\PortalBundle\Entity\Ciudades $ciudad
     */
    public function setCiudad(\Cruceo\PortalBundle\Entity\Ciudades $ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * Get ciudad
     *
     * @return Cruceo\PortalBundle\Entity\Ciudades 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set crucero
     *
     * @param Cruceo\PortalBundle\Entity\Cruceros $crucero
     */
    public function setCrucero(\Cruceo\PortalBundle\Entity\Cruceros $crucero)
    {
        $this->crucero = $crucero;
    }

    /**
     * Get crucero
     *
     * @return Cruceo\PortalBundle\Entity\Cruceros 
     */
    public function getCrucero()
    {
        return $this->crucero;
    }
}