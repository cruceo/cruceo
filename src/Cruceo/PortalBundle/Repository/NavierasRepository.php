<?php
namespace Cruceo\PortalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class NavierasRepository extends EntityRepository
{
	public function getOneBySlug($slug)
	{
		$q = $this->getEntityManager()
			->createQueryBuilder()
			->select('n, c, b')
			->from($this->getEntityName(), 'n')
			->innerJoin('n.cruceros', 'c')
            ->innerJoin('c.barco', 'b')
			->where('n.slug = ?1')
            ->groupBy('b.id')
			->setParameters(array(1 => $slug))
			->getQuery();

		return $q->getOneOrNullResult();
	}
}