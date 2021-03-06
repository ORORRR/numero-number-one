<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Avis;
use AppBundle\Entity\Oeuvre;
use Doctrine\ORM\Query\Expr\Join;

/**
 * OeuvreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OeuvreRepository extends \Doctrine\ORM\EntityRepository
{
    public function findOeuvreQueryBuilder($recherche) {
        $qb = $this->createQueryBuilder('o');
        return $qb->where($qb->expr()->like('o.nom', ':nom'))
            ->setParameter('nom', '%' . $recherche . '%');
    }

    public function findOeuvre($recherche) {
        return $this->findOeuvreQueryBuilder($recherche)
            ->getQuery()->getResult();
    }

    public function findOeuvresByCategorieByAvisCreatedBetweenTwoDates(\DateTime $beginDate, \DateTime $endDate, $categorieId)
    {
        $qb = $this->createQueryBuilder('o');
        return $qb->from(Oeuvre::class, 'oeuvre')
            ->innerJoin(Avis::class, 'avis', Join::WITH, 'o.id = avis.oeuvre')
            ->where("o.categorie = ?1")
            ->andWhere("avis.date > ?2")
            ->andWhere("avis.date < ?3")
            ->setParameter(1, $categorieId)
            ->setParameter(2, $beginDate)
            ->setParameter(3, $endDate)
            ->getQuery()
            ->getResult();
    }
}