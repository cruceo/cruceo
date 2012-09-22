<?php
namespace Cruceo\PortalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SearchedRepository extends EntityRepository
{
    public function getMostWanted()
    {
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult('search', 'search');
        $rsm->addScalarResult('num', 'num');

        $em = $this->getEntityManager();

        $q = $em->createNativeQuery(
                'SELECT
                    search as search
                    , COUNT(search) AS num
                FROM searched
                GROUP BY search
                ORDER BY num DESC, search'
            ,
            $rsm);

        return $q->getArrayResult();
    }
}