<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function search($titre) 
    {
        return $this->createQueryBuilder('Articles')
            ->andWhere('Articles.titre LIKE :titre')
            ->setParameter('titre', '%'.$titre.'%')
            ->getQuery()
            ->execute();
    }

    public function findArticles()
    {
        $qb = $this->createQueryBuilder('p');
        //$qb->where('p.status=1');
        return $qb->getQuery(); // WITHOUT ->getResult(); !!
    }

    // Retourne les 3 derniers articles les + populaires (les + lus)
    /**
    * @return Articles[] Returns an array of Articles objects
    */
    public function popularArticles(): array
    {
        return $this->createQueryBuilder('a')
            //->andWhere('a.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('a.vues', 'DESC')
            ->setMaxResults(3)
            ->select('a.titre', 'a.slug', 'a.image', 'a.vues')
            ->getQuery()
            ->getResult()
        ;
    }

    public function totalVues(): array
    {
        return $this->createQueryBuilder('a')
            ->select('SUM(a.vues) AS vuesTotal')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
