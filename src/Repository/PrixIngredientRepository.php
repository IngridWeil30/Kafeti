<?php

namespace App\Repository;

use App\Entity\PrixIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrixIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixIngredient[]    findAll()
 * @method PrixIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixIngredientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrixIngredient::class);
    }

//    /**
//     * @return PrixIngredient[] Returns an array of PrixIngredient objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrixIngredient
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
