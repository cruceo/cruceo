<?php
namespace Cruceo\PortalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BarcosRepository extends EntityRepository
{
	public function findOneByPhotoPath($img)
	{
		$q = $this->getEntityManager()
			->createQueryBuilder()
			->select('b')
			->from('CruceoPortalBundle:Barcos', 'b')
			->innerJoin('b.fotos', 'f')
			->where('f.ruta = ?1')
			->setParameters(array(1 => $img))
			->getQuery();

		return $q->getOneOrNullResult();
	}
}