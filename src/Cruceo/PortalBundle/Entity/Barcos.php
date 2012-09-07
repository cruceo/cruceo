<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cruceo\PortalBundle\Lib\Util;

/**
 * Cruceo\PortalBundle\Entity\Barcos
 *
 * @ORM\Table(name="barcos")
 * @ORM\Entity(repositoryClass="Cruceo\PortalBundle\Repository\BarcosRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Barcos
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
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string $velocidad
     *
     * @ORM\Column(name="velocidad", type="string", length=255, nullable=true)
     */
    private $velocidad;

    /**
     * @var string $manga
     *
     * @ORM\Column(name="manga", type="string", length=255, nullable=true)
     */
    private $manga;

    /**
     * @var string $eslora
     *
     * @ORM\Column(name="eslora", type="string", length=255, nullable=true)
     */
    private $eslora;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

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
     * @var Fotos
     *
     * @ORM\OneToMany(targetEntity="Fotos", mappedBy="barco", cascade={"persist", "remove"})
     */
    private $fotos;

    /**
     * @var Equipamientos
     *
     * @ORM\ManyToMany(targetEntity="Equipamientos")
     * @ORM\JoinTable(name="equipamientos_barcos",
     *      joinColumns={@ORM\JoinColumn(name="barcos_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipamientos_id", referencedColumnName="id")}
     *      )
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
     * Set velocidad
     *
     * @param string $velocidad
     */
    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
    }

    /**
     * Get velocidad
     *
     * @return string
     */
    public function getVelocidad()
    {
        return $this->velocidad;
    }

    /**
     * Set manga
     *
     * @param string $manga
     */
    public function setManga($manga)
    {
        $this->manga = $manga;
    }

    /**
     * Get manga
     *
     * @return string
     */
    public function getManga()
    {
        return $this->manga;
    }

    /**
     * Set eslora
     *
     * @param string $eslora
     */
    public function setEslora($eslora)
    {
        $this->eslora = $eslora;
    }

    /**
     * Get eslora
     *
     * @return string
     */
    public function getEslora()
    {
        return $this->eslora;
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
     * Set fotos
     *
     * @param Array $fotos
     */
    public function setFotos($fotos)
    {
        $this->fotos = $fotos;

        foreach ($this->fotos as $foto) {
            $foto->setBarco($this);
        }
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

    public function __construct()
    {
        $this->fotos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipamientos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fotos
     *
     * @param Cruceo\PortalBundle\Entity\Fotos $fotos
     */
    public function addFotos(\Cruceo\PortalBundle\Entity\Fotos $fotos)
    {
        $this->fotos[] = $fotos;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    public function getUploadRootDir($name = null)
    {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
        '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.$this->getUploadDir($name);
    }

    public function getUploadDir($name = null)
    {
        $name = null === $name ? $this->getNombre() : $name;

        return 'photos/'.Util::sanitizeString(strtolower($name), array(), array(' ' => '-')).'-'.$this->getId();
    }

    public function getThumbsWebDir()
    {
        return $this->getUploadDir().DIRECTORY_SEPARATOR.'thumbs';
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeUpload()
    {
        $dir = $this->getUploadDir();
        if (is_dir($this->getUploadDir())) {
            Util::deleteDir($dir);
        }
    }

    /**
     * Get equipamientos
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getEquipamientos()
    {
        return $this->equipamientos;
    }

    /**
     * Set equipamientos
     *
     * @param Array $equipamientos
     */
    public function setEquipamientos($equipamientos)
    {
        $this->equipamientos = $equipamientos;
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