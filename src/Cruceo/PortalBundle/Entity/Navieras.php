<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\Navieras
 *
 * @ORM\Table(name="navieras")
 * @ORM\Entity
 */
class Navieras
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;



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
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Magic method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNombre();
    }
}