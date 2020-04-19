<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }


    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findLast()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = :val')
            ->setParameter('val', 0)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findAllOnMarket()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = :val')
            ->setParameter('val', 0)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Property
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
