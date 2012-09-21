<?php

namespace Cruceo\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruceo\PortalBundle\Entity\Searched
 *
 * @ORM\Table(name="searched")
 * @ORM\Entity(repositoryClass="Cruceo\PortalBundle\Repository\SearchedRepository")
 */
class Searched
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
     * @var string $search
     *
     * @ORM\Column(name="search", type="string", length=100, nullable=false)
     */
    private $search;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;



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
     * Set search
     *
     * @param string $search
     */
    public function setSearch($search)
    {
        $this->search = $search;
    }

    /**
     * Get search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
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
}