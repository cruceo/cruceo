<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\Cruceros
 *
 * @ORM\Table(name="cruceros")
 * @ORM\Entity
 */
class Cruceros
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
     * @var text $detalles
     *
     * @ORM\Column(name="detalles", type="text", nullable=true)
     */
    private $detalles;

    /**
     * @var text $equipamiento
     *
     * @ORM\Column(name="equipamiento", type="text", nullable=true)
     */
    private $equipamiento;

    /**
     * @var text $itinerario
     *
     * @ORM\Column(name="itinerario", type="text", nullable=true)
     */
    private $itinerario;

    /**
     * @var string $imgItinerario
     *
     * @ORM\Column(name="img_itinerario", type="string", length=255, nullable=true)
     */
    private $imgItinerario;

    /**
     * @var string $imgBarco
     *
     * @ORM\Column(name="img_barco", type="string", length=255, nullable=true)
     */
    private $imgBarco;

    /**
     * @var datetime $fechaSalida
     *
     * @ORM\Column(name="fecha_salida", type="datetime", nullable=false)
     */
    private $fechaSalida;

    /**
     * @var string $promocion
     *
     * @ORM\Column(name="promocion", type="string", length=255, nullable=true)
     */
    private $promocion;

    /**
     * @var string $incluidoPrecio
     *
     * @ORM\Column(name="incluido_precio", type="string", length=255, nullable=true)
     */
    private $incluidoPrecio;

    /**
     * @var string $noIncluidoPrecio
     *
     * @ORM\Column(name="no_incluido_precio", type="string", length=255, nullable=true)
     */
    private $noIncluidoPrecio;

    /**
     * @var Navieras
     *
     * @ORM\ManyToOne(targetEntity="Navieras")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="naviera_id", referencedColumnName="id")
     * })
     */
    private $naviera;

    /**
     * @var Zonas
     *
     * @ORM\ManyToOne(targetEntity="Zonas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zona_id", referencedColumnName="id")
     * })
     */
    private $zona;

    /**
     * @var Ciudades
     *
     * @ORM\ManyToMany(targetEntity="Ciudades")
     * @ORM\JoinTable(name="ciudades_cruceros",
     *      joinColumns={@ORM\JoinColumn(name="crucero_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")}
     *      )
     */
    private $ciudades;

    /**
     * @var Precios
     *
     * @ORM\OneToMany(targetEntity="Precios", mappedBy="crucero")
     */
    private $precios;

    /**
     * @var Precios
     *
     * @ORM\OneToMany(targetEntity="Fotos", mappedBy="crucero")
     */
    private $fotos;


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
     * Set detalles
     *
     * @param text $detalles
     */
    public function setDetalles($detalles)
    {
        $this->detalles = $detalles;
    }

    /**
     * Get detalles
     *
     * @return text 
     */
    public function getDetalles()
    {
        return $this->detalles;
    }

    /**
     * Set equipamiento
     *
     * @param text $equipamiento
     */
    public function setEquipamiento($equipamiento)
    {
        $this->equipamiento = $equipamiento;
    }

    /**
     * Get equipamiento
     *
     * @return text 
     */
    public function getEquipamiento()
    {
        return $this->equipamiento;
    }

    /**
     * Set itinerario
     *
     * @param text $itinerario
     */
    public function setItinerario($itinerario)
    {
        $this->itinerario = $itinerario;
    }

    /**
     * Get itinerario
     *
     * @return text 
     */
    public function getItinerario()
    {
        return $this->itinerario;
    }

    /**
     * Set imgItinerario
     *
     * @param string $imgItinerario
     */
    public function setImgItinerario($imgItinerario)
    {
        $this->imgItinerario = $imgItinerario;
    }

    /**
     * Get imgItinerario
     *
     * @return string 
     */
    public function getImgItinerario()
    {
        return $this->imgItinerario;
    }

    /**
     * Set imgBarco
     *
     * @param string $imgBarco
     */
    public function setImgBarco($imgBarco)
    {
        $this->imgBarco = $imgBarco;
    }

    /**
     * Get imgBarco
     *
     * @return string 
     */
    public function getImgBarco()
    {
        return $this->imgBarco;
    }

    /**
     * Set fechaSalida
     *
     * @param datetime $fechaSalida
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;
    }

    /**
     * Get fechaSalida
     *
     * @return datetime 
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set promocion
     *
     * @param string $promocion
     */
    public function setPromocion($promocion)
    {
        $this->promocion = $promocion;
    }

    /**
     * Get promocion
     *
     * @return string 
     */
    public function getPromocion()
    {
        return $this->promocion;
    }

    /**
     * Set incluidoPrecio
     *
     * @param string $incluidoPrecio
     */
    public function setIncluidoPrecio($incluidoPrecio)
    {
        $this->incluidoPrecio = $incluidoPrecio;
    }

    /**
     * Get incluidoPrecio
     *
     * @return string 
     */
    public function getIncluidoPrecio()
    {
        return $this->incluidoPrecio;
    }

    /**
     * Set noIncluidoPrecio
     *
     * @param string $noIncluidoPrecio
     */
    public function setNoIncluidoPrecio($noIncluidoPrecio)
    {
        $this->noIncluidoPrecio = $noIncluidoPrecio;
    }

    /**
     * Get noIncluidoPrecio
     *
     * @return string 
     */
    public function getNoIncluidoPrecio()
    {
        return $this->noIncluidoPrecio;
    }

    /**
     * Set naviera
     *
     * @param Cruceo\PortalBundle\Entity\Navieras $naviera
     */
    public function setNaviera(\Cruceo\PortalBundle\Entity\Navieras $naviera)
    {
        $this->naviera = $naviera;
    }

    /**
     * Get naviera
     *
     * @return Cruceo\PortalBundle\Entity\Navieras 
     */
    public function getNaviera()
    {
        return $this->naviera;
    }

    /**
     * Set zona
     *
     * @param Cruceo\PortalBundle\Entity\Zonas $zona
     */
    public function setZona(\Cruceo\PortalBundle\Entity\Zonas $zona)
    {
        $this->zona = $zona;
    }

    /**
     * Get zona
     *
     * @return Cruceo\PortalBundle\Entity\Zonas 
     */
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * Set precios
     *
     * @param Cruceo\PortalBundle\Entity\Precios $precio
     */
    public function setPrecios(\Cruceo\PortalBundle\Entity\Precios $precio)
    {
        $this->precios[] = $precio;
    }

    /**
     * Get precios
     *
     * @return Doctrine\Common\Collections\Collection $precios
     */
    public function getPrecios()
    {
        return $this->precios;
    }

    /**
     * Set fotos
     *
     * @param Cruceo\PortalBundle\Entity\Fotos $foto
     */
    public function setFotos(\Cruceo\PortalBundle\Entity\Fotos $foto)
    {
        $this->fotos[] = $foto;
    }

    /**
     * Get fotos
     *
     * @return Doctrine\Common\Collections\Collection $fotos
     */
    public function getFotos()
    {
        return $this->fotos;
    }
}