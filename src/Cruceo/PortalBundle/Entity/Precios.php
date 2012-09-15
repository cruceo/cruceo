<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\Precios
 *
 * @ORM\Table(name="precios")
 * @ORM\Entity
 */
class Precios
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
     * @var float $precio
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     */
    private $precio;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var date $fecha
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var text $caracteristicasTipologia
     *
     * @ORM\Column(name="caracteristicas_tipologia", type="text", nullable=true)
     */
    private $caracteristicasTipologia;

    /**
     * @var text $destacado
     *
     * @ORM\Column(name="destacado", type="integer", nullable=true)
     */
    private $destacado;

    /**
     * @var Cruceros
     *
     * @ORM\ManyToOne(targetEntity="Cruceros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crucero_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $crucero;

    /**
     * @var Agencias
     *
     * @ORM\ManyToOne(targetEntity="Agencias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agencia_id", referencedColumnName="id")
     * })
     */
    private $agencia;

    /**
     * @var Tipologias
     *
     * @ORM\ManyToOne(targetEntity="Tipologias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipologia_id", referencedColumnName="id")
     * })
     */
    private $tipologia;


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
     * Set precio
     *
     * @param float $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set caracteristicasTipologia
     *
     * @param text $caracteristicasTipologia
     */
    public function setCaracteristicasTipologia($caracteristicasTipologia)
    {
        $this->caracteristicasTipologia = $caracteristicasTipologia;
    }

    /**
     * Get caracteristicasTipologia
     *
     * @return text
     */
    public function getCaracteristicasTipologia()
    {
        return $this->caracteristicasTipologia;
    }

    /**
     * Set destacado
     *
     * @param integer $destacado
     */
    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;
    }

    /**
     * Get destacado
     *
     * @return integer
     */
    public function getDestacado()
    {
        return $this->destacado;
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

    /**
     * Set agencia
     *
     * @param Cruceo\PortalBundle\Entity\Agencias $agencia
     */
    public function setAgencia(\Cruceo\PortalBundle\Entity\Agencias $agencia)
    {
        $this->agencia = $agencia;
    }

    /**
     * Get agencia
     *
     * @return Cruceo\PortalBundle\Entity\Agencias
     */
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * Set tipologia
     *
     * @param Cruceo\PortalBundle\Entity\Tipologias $tipologia
     */
    public function setTipologia(\Cruceo\PortalBundle\Entity\Tipologias $tipologia)
    {
        $this->tipologia = $tipologia;
    }

    /**
     * Get tipologia
     *
     * @return Cruceo\PortalBundle\Entity\Tipologias
     */
    public function getTipologia()
    {
        return $this->tipologia;
    }
}