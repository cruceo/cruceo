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
     * @var Categorias
     *
     * @ORM\ManyToOne(targetEntity="Categorias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

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
     * @var Agencias
     *
     * @ORM\ManyToOne(targetEntity="Agencias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agencia_id", referencedColumnName="id")
     * })
     */
    private $agencia;



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
     * Set categoria
     *
     * @param Cruceo\PortalBundle\Entity\Categorias $categoria
     */
    public function setCategoria(\Cruceo\PortalBundle\Entity\Categorias $categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * Get categoria
     *
     * @return Cruceo\PortalBundle\Entity\Categorias 
     */
    public function getCategoria()
    {
        return $this->categoria;
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
}