<?php

namespace App\Repository;

use App\Entity\ProjectService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjectService|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectService|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectService[]    findAll()
 * @method ProjectService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectService::class);
    }

//    /**
//     * @return ProjectService[] Returns an array of ProjectService objects
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
    public function findOneBySomeField($value): ?ProjectService
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
