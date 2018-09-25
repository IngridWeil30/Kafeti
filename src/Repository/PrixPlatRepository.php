<?php

namespace App\Repository;

use App\Entity\PrixPlat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrixPlat|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixPlat|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixPlat[]    findAll()
 * @method PrixPlat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixPlatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrixPlat::class);
    }

//    /**
//     * @return PrixPlat[] Returns an array of PrixPlat objects
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
    public function findOneBySomeField($value): ?PrixPlat
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
