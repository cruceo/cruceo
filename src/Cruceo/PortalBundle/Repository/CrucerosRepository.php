<?php
namespace Cruceo\PortalBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class CrucerosRepository extends EntityRepository
{
	public function findOneByImgItinerario($img)
	{
		$q = $this->getEntityManager()
			->createQueryBuilder()
			->select('c')
			->from('CruceoPortalBundle:Cruceros', 'c')
			->where('c.imgItinerario = ?1')
			->setParameter(1, $img)
			->getQuery();

		return $q->getOneOrNullResult();
	}

    public function getHighLighted()
    {
        $q = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('c, p, n, a, p2')
            ->from($this->getEntityName(), 'c')
            ->innerJoin('c.precios', 'p', Expr\Join::WITH, 'p.destacado >= 1')
            ->innerJoin('c.naviera', 'n')
            ->innerJoin('p.agencia', 'a')
            ->leftJoin('c.precios', 'p2', Expr\Join::WITH, 'p2.destacado IS NULL')
            ->orderBy('p.destacado, p.precio')
            ->getQuery();

        return $q->getResult();
    }

    public function getOneBySlug($slug)
    {
        $q = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('c, b, cc, n, p, z, ci, a')
            ->from('CruceoPortalBundle:Cruceros', 'c')
            ->innerJoin('c.barco', 'b')
            ->innerJoin('c.ciudadesCruceros', 'cc')
            ->innerJoin('cc.ciudad', 'ci')
            ->innerJoin('c.naviera', 'n')
            ->innerJoin('c.zona', 'z')
            ->leftJoin('c.precios', 'p ')
            ->innerJoin('p.agencia', 'a')
            ->where('c.slug = ?1')
            ->orderBy('p.destacado, p.precio, cc.diaCrucero')
            ->setParameter(1, $slug)
            ->getQuery();

        return $q->getOneOrNullResult();
    }
}