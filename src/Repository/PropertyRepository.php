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
    public function findAllOnMarket($search)
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.sold = :val')
            ->setParameter('val', 0)
            ->orderBy('p.id', 'ASC');

        if ($search->getCity()) {
            $query = $query
                ->andWhere('p.city = :val')
                ->setParameter('val', $search->getCity());
        }

        if ($search->getMinSurface()) {
            $query = $query
                ->andWhere('p.surface >= :minSurface')
                ->setParameter('minSurface', $search->getMinSurface());
        }

        if ($search->getMaxSurface()) {
            $query = $query
                ->andWhere('p.surface <= :maxSurface')
                ->setParameter('maxSurface', $search->getMaxSurface());
        }

        if ($search->getMinPrice()) {
            $query = $query
                ->andWhere('p.price >= :minPrice')
                ->setParameter('minPrice', $search->getMinPrice());
        }

        if ($search->getMaxPrice()) {
            $query = $query
                ->andWhere('p.price <= :maxPrice')
                ->setParameter('maxPrice', $search->getMaxPrice());
        }

        if ($search->getOptions()->count() > 0) {
            foreach ($search->getOptions() as $key => $option) {
                $query = $query
                    ->andWhere(":option$key MEMBER OF p.options")
                    ->setParameter("option$key", $option);
            }
        }

        return $query
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
