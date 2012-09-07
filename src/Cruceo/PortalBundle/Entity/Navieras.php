<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cruceo\PortalBundle\Lib\Util;

/**
 * Cruceo\PortalBundle\Entity\Navieras
 *
 * @ORM\Table(name="navieras")
 * @ORM\Entity(repositoryClass="Cruceo\PortalBundle\Repository\NavierasRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     *
     * @ORM\OneToMany(targetEntity="Cruceros", mappedBy="naviera")
     */
    private $cruceros;


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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set cruceros
     *
     * @param array $crucero
     */
    public function setCruceros($crucero)
    {
        $this->cruceros[] = $crucero;
    }

    /**
     * Get cruceros
     *
     * @return collection
     */
    public function getCruceros()
    {
        return $this->cruceros;
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

    /**
     * Create slug automatically
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function createSlug()
    {
        $this->setSlug(Util::generateSlug($this->getNombre()));
    }
}