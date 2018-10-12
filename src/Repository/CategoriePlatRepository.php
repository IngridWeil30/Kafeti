<?php

namespace App\Repository;

use App\Entity\CategoriePlat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoriePlat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriePlat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriePlat[]    findAll()
 * @method CategoriePlat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriePlatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoriePlat::class);
    }
    
    public function findContinentByAsc() {
        $query = $this->createQueryBuilder('cp')
        ->addOrderBy('cp.continent', 'ASC')
        ->addOrderBy('cp.denomination', 'ASC')
        ->getQuery()
        ->getResult();
        
        return $query;
    }

//    /**
//     * @return CategoriePlat[] Returns an array of CategoriePlat objects
//     */
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
    public function findOneBySomeField($value): ?CategoriePlat
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
