<?php

namespace App\Repository;

use App\Entity\Commentaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaires[]    findAll()
 * @method Commentaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaires::class);
    }

    // Retourne les 3 derniers commentaires (par date)
    /**
    * @return Commentaires[] Returns an array of Commentaires objects
    */
    public function lastComments(): array
    {
        return $this->createQueryBuilder('c')
            //->andWhere('a.exampleField = :val')
            //->setParameter('val', $value)
            ->join('c.auteur', 'a')
            ->join('c.article', 'b')
            ->orderBy('c.id', 'DESC')
            ->select('a.username', 'b.slug', 'c.id', 'c.contenu', 'c.created_at')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return Commentaires[] Returns an array of Commentaires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commentaires
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
