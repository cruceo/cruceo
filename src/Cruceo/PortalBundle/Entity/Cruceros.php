<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cruceo\PortalBundle\Lib\Util;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cruceo\PortalBundle\Entity\Cruceros
 *
 * @ORM\Table(name="cruceros")
 * @ORM\Entity(repositoryClass="Cruceo\PortalBundle\Repository\CrucerosRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @var text $detalles
     *
     * @ORM\Column(name="detalles", type="text", nullable=true)
     */
    private $detalles;

    /**
     * @var text $itinerario
     *
     * @ORM\Column(name="itinerario", type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $itinerario;

    /**
     * @var string $imgItinerario
     *
     * @ORM\Column(name="img_itinerario", type="string", length=255, nullable=true)
     */
    private $imgItinerario;

    /**
     * @var File $imgItinerarioFile
     */
    private $imgItinerarioFile;

    /**
     * @var datetime $fechaSalida
     *
     * @ORM\Column(name="fecha_salida", type="date", nullable=false)
     * @Assert\NotBlank
     */
    private $fechaSalida;

    /**
     * @var integer $duracion
     *
     * @ORM\Column(name="duracion", type="integer", nullable=true)
     */
    private $duracion;

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
     * @Assert\NotBlank
     */
    private $naviera;

    /**
     * @var Zonas
     *
     * @ORM\ManyToOne(targetEntity="Zonas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zona_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank
     */
    private $zona;

    /**
     * @var Ciudades old
     *
     * @ ORM\ManyToMany(targetEntity="Ciudades", cascade={"persist"})
     * @ ORM\JoinTable(name="ciudades_cruceros",
     *      joinColumns={@ORM\JoinColumn(name="crucero_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")}
     *      )
     */
    //private $ciudades;

    /**
     * @var ciudadesCruceros
     *
     * @ORM\OneToMany(targetEntity="CiudadesCruceros", mappedBy="crucero", cascade={"all"})
     */
    protected $ciudadesCruceros;

    protected $ciudades;

    /**
     * @var Precios
     *
     * @ORM\OneToMany(targetEntity="Precios", mappedBy="crucero", cascade={"persist", "remove"})
     * @Assert\NotBlank
     */
    private $precios;

    /**
     * @var Barcos
     *
     * @ORM\ManyToOne(targetEntity="Barcos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="barco_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank
     */
    private $barco;


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
    public function getImgItinerarioFile()
    {
        return $this->imgItinerarioFile;
    }

    /**
     * Set imgItinerario
     *
     * @param string $imgItinerario
     */
    public function setImgItinerarioFile($imgItinerarioFile)
    {
        $this->imgItinerarioFile = $imgItinerarioFile;
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
     * Set fechaSalida
     *
     * @param date $fechaSalida
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
     * Set duracion
     *
     * @param integer $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    /**
     * Get duracion
     *
     * @return integer
     */
    public function getDuracion()
    {
        return $this->duracion;
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
     * @param Array $precios
     */
    public function setPrecios($precios)
    {
        $this->precios = $precios;

        foreach ($this->precios as $precio) {
            $precio->setCrucero($this);
        }
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
     * Set barco
     *
     * @param Cruceo\PortalBundle\Entity\Barcos $barco
     */
    public function setBarco(\Cruceo\PortalBundle\Entity\Barcos $barco)
    {
        $this->barco = $barco;
    }

    /**
     * Get barco
     *
     * @return Cruceo\PortalBundle\Entity\Barcos
     */
    public function getBarco()
    {
        return $this->barco;
    }

    public function __construct()
    {
        $this->ciudadesCruceros = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ciudades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->precios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getCiudades()
    {
        return $this->ciudadesCruceros;
    }

    public function setCiudades($ciudadesCruceros)
    {
        foreach($ciudadesCruceros as $ciudadCrucero)
        {
            $ciudadCrucero->setCrucero($this);

            $this->addCiudadCrucero($ciudadCrucero);
        }
    }

    public function getOrder()
    {
        return $this;
    }

    public function addCiudadCrucero($ciudadCrucero)
    {
        $this->ciudadesCruceros[] = $ciudadCrucero;
    }

    /**
     * Get OLD ciudades
     *
     * @return Doctrine\Common\Collections\Collection
     */
    /*public function getCiudades()
    {
        return $this->ciudades;
    }*/

    /*public function setCiudades($ciudades)
    {
        $this->ciudades = $ciudades;
    }*/

    /*************************************
     * Functions for uploads img_itinario
     *************************************/
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->imgItinerarioFile) {
            $this->imgItinerario = uniqid().'.'.$this->imgItinerarioFile->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->imgItinerarioFile) {
            return;
        }

        $this->imgItinerarioFile->move($this->getUploadRootDir(), $this->imgItinerario);

        unset($this->imgItinerarioFile);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeUpload()
    {
        if ($this->imgItinerario) {
            @unlink($this->getUploadRootDir().DIRECTORY_SEPARATOR.$this->imgItinerario);
            @rmdir($this->getUploadRootDir());
        }
    }

    public function getUploadRootDir($name = null)
    {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
            '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.$this->getUploadDir($name);
    }

    public function getUploadDir($name = null)
    {
        $name = null === $name ? $this->getNombre() : $name;

        return 'cruises/'.Util::sanitizeString(strtolower($name), array(), array(' ' => '-')).'-'.$this->getId();
    }
}