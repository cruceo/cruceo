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
            ->leftJoin('n.barcos', 'b')
			->leftJoin('b.cruceros', 'c')
			->where('n.slug = ?1')
			->setParameters(array(1 => $slug))
			->getQuery();

		return $q->getOneOrNullResult();
	}
}