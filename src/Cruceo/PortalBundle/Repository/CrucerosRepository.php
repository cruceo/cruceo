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
            ->select('c, p, a, p2, f, b')
            ->from($this->getEntityName(), 'c')
            ->innerJoin('c.precios', 'p', Expr\Join::WITH, 'p.destacado >= 1')
            ->innerJoin('p.agencia', 'a')
            ->innerJoin('c.barco', 'b')
            ->innerJoin('b.fotos', 'f')
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
            ->innerJoin('c.ciudadesCruceros', 'cc')
            ->innerJoin('cc.ciudad', 'ci')
            ->innerJoin('c.barco', 'b')
            ->innerJoin('b.naviera', 'n')
            ->innerJoin('c.zona', 'z')
            ->leftJoin('c.precios', 'p ')
            ->innerJoin('p.agencia', 'a')
            ->where('c.slug = ?1')
            ->orderBy('p.destacado, p.precio, cc.diaCrucero')
            ->setParameter(1, $slug)
            ->getQuery();

        return $q->getOneOrNullResult();
    }

    public function searchHome($str, $start = null, $duration = null, $zone = null)
    {
        $q = $this->getQueryBuilderForSearch($str, $start, $duration, $duration, $zone)
            ->select('c, p, n, a, cc, cd, b, f')
            ->getQuery();

        return $q->getResult();
    }

    public function advancedSearch($str, $start = null, $duration = null, $zone = null,
                                   $category = null, $cabin = null, $equipment = null, $shipping = null,
                                   $min = null, $max = null)
    {
        $q = $this->getQueryBuilderForSearch($str, $start, $duration, $duration, $zone);

        $q->innerJoin('p.tipologia', 't')
            ->innerJoin('b.categoria', 'ct')
            ->innerJoin('b.equipamientos', 'e');

        if (! empty($category)) {
            $q->andWhere('ct.id = :category')->setParameter('category', $category);
        }

        if (! empty($cabin)) {
            $q->andWhere('t.id = :cabin')->setParameter('cabin', $cabin);
        }

        if (! empty($equipment)) {
            $q->andWhere($q->expr()->in('e.id', $equipment));
        }

        if (! empty($shipping)) {
            $q->andWhere('n.id = :shipping')->setParameter('shipping', $shipping);
        }

        if ((is_numeric($min) && 0 != $min) && (is_numeric($max) && 0 != $max)) {
            $between = $q->expr()->between('p.precio', $min, $max);
            $q->andWhere($between);
        }

        $q->select('c, p, n, a, cc, cd, t, b, ct, e, f');

        return $q->getQuery()->getResult();
    }

    private function getQueryBuilderForSearch($str, $start, $duration, $zone)
    {
        $q = $this->getEntityManager()->createQueryBuilder()
            ->from($this->getEntityName(), 'c')
            ->innerJoin('c.precios', 'p')
            ->innerJoin('p.agencia', 'a')
            ->innerJoin('c.ciudadesCruceros', 'cc')
            ->innerJoin('cc.ciudad', 'cd')
            ->innerJoin('c.barco', 'b')
            ->innerJoin('b.naviera', 'n')
            ->leftJoin('b.fotos', 'f')
            ->orderBy('p.destacado, p.precio');

        $strModule = $q->expr()->orX();
        $strModule->add($q->expr()->like('c.nombre', ':str'));
        $strModule->add($q->expr()->like('cd.nombre', ':str'));
        $strModule->add($q->expr()->like('n.nombre', ':str'));

        $q->where($strModule)
            ->setParameter('str', '%'.$str.'%');

        if (! empty($start)) {
            $q->andWhere('p.fecha = :start')->setParameter('start', $start);
        }

        if (! empty($duration)) {
            $q->andWhere('c.duracion = :duration')->setParameter('duration', $duration);
        }

        if (! empty($zone)) {
            $q->andWhere('c.zona = :zone')->setParameter('zone', $zone);
        }

        return $q;
    }

    public function getMaxPriceForSearch($str, $start, $duration, $zone)
    {
        $q = $this->getQueryBuilderForSearch($str, $start, $duration, $zone);
        $q->select('MAX(p.precio)');

        return $q->getQuery()->getSingleScalarResult();
    }

    public function getMinPriceForSearch($str, $start, $duration, $zone)
    {
        $q = $this->getQueryBuilderForSearch($str, $start, $duration, $zone);
        $q->select('MIN(p.precio)');

        return $q->getQuery()->getSingleScalarResult();
    }
}