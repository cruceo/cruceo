<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\EquipamientosBarcos
 *
 * @ORM\Table(name="equipamientos_barcos")
 * @ORM\Entity
 */
class EquipamientosBarcos
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
     * @var Barcos
     *
     * @ORM\ManyToOne(targetEntity="Barcos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="barcos_id", referencedColumnName="id")
     * })
     */
    private $barcos;

    /**
     * @var Equipamientos
     *
     * @ORM\ManyToOne(targetEntity="Equipamientos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipamientos_id", referencedColumnName="id")
     * })
     */
    private $equipamientos;


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
     * Set barcos
     *
     * @param Cruceo\PortalBundle\Entity\Barcos $barcos
     */
    public function setBarcos(\Cruceo\PortalBundle\Entity\Barcos $barcos)
    {
        $this->barcos = $barcos;
    }

    /**
     * Get barcos
     *
     * @return Cruceo\PortalBundle\Entity\Barcos
     */
    public function getBarcos()
    {
        return $this->barcos;
    }

    /**
     * Set equipamientos
     *
     * @param Cruceo\PortalBundle\Entity\Equipamientos $equipamientos
     */
    public function setEquipamientos(\Cruceo\PortalBundle\Entity\Equipamientos $equipamientos)
    {
        $this->equipamientos = $equipamientos;
    }

    /**
     * Get equipamientos
     *
     * @return Cruceo\PortalBundle\Entity\Equipamientos
     */
    public function getEquipamientos()
    {
        return $this->equipamientos;
    }
}