<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\LugaresTuristicos
 *
 * @ORM\Table(name="lugares_turisticos")
 * @ORM\Entity
 */
class LugaresTuristicos
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var TiposLugares
     *
     * @ORM\ManyToOne(targetEntity="TiposLugares")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipos_lugares_id", referencedColumnName="id")
     * })
     */
    private $tiposLugares;

    /**
     * @var Ciudades
     *
     * @ORM\ManyToOne(targetEntity="Ciudades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudades_id", referencedColumnName="id")
     * })
     */
    private $ciudades;



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
     * Set descripcion
     *
     * @param text $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return text 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tiposLugares
     *
     * @param Cruceo\PortalBundle\Entity\TiposLugares $tiposLugares
     */
    public function setTiposLugares(\Cruceo\PortalBundle\Entity\TiposLugares $tiposLugares)
    {
        $this->tiposLugares = $tiposLugares;
    }

    /**
     * Get tiposLugares
     *
     * @return Cruceo\PortalBundle\Entity\TiposLugares 
     */
    public function getTiposLugares()
    {
        return $this->tiposLugares;
    }

    /**
     * Set ciudades
     *
     * @param Cruceo\PortalBundle\Entity\Ciudades $ciudades
     */
    public function setCiudades(\Cruceo\PortalBundle\Entity\Ciudades $ciudades)
    {
        $this->ciudades = $ciudades;
    }

    /**
     * Get ciudades
     *
     * @return Cruceo\PortalBundle\Entity\Ciudades 
     */
    public function getCiudades()
    {
        return $this->ciudades;
    }
}