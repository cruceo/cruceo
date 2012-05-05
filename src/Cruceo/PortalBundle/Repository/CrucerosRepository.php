<?php
namespace Cruceo\PortalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CrucerosRepository extends EntityRepository
{
	public function findOneByImgItinerario($img)
	{
		$q = $this->getEntityManager()
			->createQueryBuilder()
			->select('c')
			->from('CruceoPortalBundle:Cruceros', 'c')
			->where('c.imgItinerario = ?1')
			->setParameters(array(1 => $img))
			->getQuery();

		return $q->getOneOrNullResult();
	}
}