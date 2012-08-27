<?php
namespace Cruceo\PortalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CiudadesRepository extends EntityRepository
{
    public function getAllCitiesByCountry($country, $hydrate = \Doctrine\ORM\Query::HYDRATE_ARRAY)
    {
        $q = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('c.id, c.nombre')
            ->from('CruceoPortalBundle:Ciudades', 'c')
            ->where('c.pais = ?1');

        return $q->getQuery()
            ->setParameter(1, $country)
            ->getResult($hydrate);
    }

    public function getCountriesInCities(array $cities, $hydrate = \Doctrine\ORM\Query::HYDRATE_ARRAY)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.id, c.pais')
            ->from('CruceoPortalBundle:Ciudades', 'c')
            ->where($qb->expr()->in('c.id', $cities));

        return $qb->getQuery()
            ->getResult($hydrate);
    }
}