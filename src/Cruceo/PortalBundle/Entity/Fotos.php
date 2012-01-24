<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\Fotos
 *
 * @ORM\Table(name="fotos")
 * @ORM\Entity
 */
class Fotos
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
     * @var string $ruta
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

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
     * Set ruta
     *
     * @param string $ruta
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
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