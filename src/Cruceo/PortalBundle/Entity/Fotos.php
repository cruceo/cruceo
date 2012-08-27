<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\Fotos
 *
 * @ORM\Table(name="fotos")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @var File $rutaFile
     *
     */
    private $rutaFile;

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var Barcos
     *
     * @ORM\ManyToOne(targetEntity="Barcos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="barco_id", referencedColumnName="id")
     * })
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
     * Set rutaFile
     *
     * @param string $rutaFile
     */
    public function setRutaFile($rutaFile)
    {
        $this->rutaFile = $rutaFile;
    }

    /**
     * Get rutaFile
     *
     * @return string
     */
    public function getRutaFile()
    {
        return $this->rutaFile;
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

    /*************************************
     * Functions for uploads ruta
    *************************************/
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->rutaFile) {
            $this->ruta = uniqid().'.'.$this->rutaFile->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->rutaFile) {
            return;
        }

        $this->rutaFile->move($this->getBarco()->getUploadRootDir(), $this->ruta);

        unset($this->rutaFile);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeUpload()
    {
        if ($this->ruta) {
            $barco = $this->getBarco();
            @unlink($barco->getUploadRootDir().DIRECTORY_SEPARATOR.$this->ruta);
        }
    }
}