<?php

namespace App\Repository;

use App\Entity\PrixMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrixMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixMenu[]    findAll()
 * @method PrixMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixMenuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrixMenu::class);
    }

//    /**
//     * @return PrixMenu[] Returns an array of PrixMenu objects
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
    public function findOneBySomeField($value): ?PrixMenu
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
