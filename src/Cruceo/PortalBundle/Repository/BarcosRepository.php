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
			->setParameter(1, $img)
			->getQuery();

		return $q->getOneOrNullResult();
	}

    public function getOnebySlug($slug)
    {
        $q = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('b, c, f, e')
            ->from($this->getEntityName(), 'b')
            ->innerJoin('b.categoria', 'c')
            ->leftJoin('b.fotos', 'f')
            ->leftJoin('b.equipamientos', 'e')
            ->where('b.slug = ?1')
            ->setParameter(1, $slug)
            ->getQuery();

        return $q->getOneOrNullResult();
    }
}