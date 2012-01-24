<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\CiudadesCruceros
 *
 * @ORM\Table(name="ciudades_cruceros")
 * @ORM\Entity
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
     * @var Ciudades
     *
     * @ORM\ManyToOne(targetEntity="Ciudades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     * })
     */
    private $ciudad;

    /**
     * @var Cruceros
     *
     * @ORM\ManyToOne(targetEntity="Cruceros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crucero_id", referencedColumnName="id")
     * })
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