<?php

namespace App\Repository;

use App\Entity\Service;
use App\Entity\ProjectService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Service::class);
    }

//    /**
//     * @return Service[] Returns an array of Service objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Service
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Service[] Returns an array of Task objects
     */
    public function servicesByProject($id)
    {
        $em = $this->getEntityManager();
        $project_services = $em->createQueryBuilder()->select('ps')
            ->from('App\Entity\ProjectService', 'ps')
            ->where('ps.project = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult();
        // dump($project_services);die;
        return $project_services;
    }
}
