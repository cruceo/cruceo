<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\Ciudades
 *
 * @ORM\Table(name="ciudades")
 * @ORM\Entity(repositoryClass="Cruceo\PortalBundle\Repository\CiudadesRepository")
 */
class Ciudades
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
     * @var string $pais
     *
     * @ORM\Column(name="pais", type="string", length=100, nullable=false)
     */
    private $pais;

    /**
     * @var lugaresTuristicos
     *
     * @ORM\OneToMany(targetEntity="LugaresTuristicos", mappedBy="ciudades", cascade={"persist", "remove"})
     */
    private $lugaresTuristicos;

    /**
     * @var ciudadesCruceros
     *
     * @ORM\OneToMany(targetEntity="CiudadesCruceros" , mappedBy="ciudad" , cascade={"all"})
     */
    protected $ciudadesCruceros;


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
     * Set pais
     *
     * @param string $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Get lugaresTuristicos
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getLugaresTuristicos()
    {
        return $this->lugaresTuristicos;
    }

    /**
     * Set lugaresTuristicos
     *
     * @param Array $lugaresTuristicos
     */
    public function setLugaresTuristicos($lugaresTuristicos)
    {
        $this->lugaresTuristicos = $lugaresTuristicos;

        foreach ($this->lugaresTuristicos as $lugar) {
            $lugar->setCiudades($this);
        }
    }

    /**
     * Magic method object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNombre().' ('.$this->getPais().')';
    }

}