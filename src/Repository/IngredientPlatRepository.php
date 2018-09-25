<?php

namespace App\Repository;

use App\Entity\IngredientPlat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IngredientPlat|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientPlat|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientPlat[]    findAll()
 * @method IngredientPlat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientPlatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IngredientPlat::class);
    }

//    /**
//     * @return IngredientPlat[] Returns an array of IngredientPlat objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientPlat
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
