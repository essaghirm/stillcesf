<?php

namespace App\Repository;

use App\Entity\Meeting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Meeting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meeting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meeting[]    findAll()
 * @method Meeting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeetingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Meeting::class);
    }

//    /**
//     * @return Meeting[] Returns an array of Meeting objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Meeting
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * @return Task[] Returns an array of Task objects
     */
    public function what($what, $user = null){

        $em = $this->getEntityManager();

        
        switch ($what) {
            case 'attachedToMe':
                return $this->createQueryBuilder('m')
                    ->andWhere('m.attachedTo = :val')
                    ->setParameter('val', $user)
                    ->orderBy('m.date', 'ASC')
                    ->getQuery()
                    ->getResult();
                break;
                
            case 'related':
                $projects = $em->createQueryBuilder()->select('p')
                    ->from('App\Entity\Project', 'p')
                    ->where('p.user = :val')
                    ->setParameter('val', $user)
                    ->getQuery()
                    ->getResult();

                // dump($projects);die;
                return  $this->createQueryBuilder('m')
                    ->andWhere('m.project in (:val)')
                    ->setParameter('val', $projects)
                    ->orderBy('m.date', 'ASC')
                    ->getQuery()
                    ->getResult();
                // dump($tasks);die;
            break;
            
            default:
                return  $this->createQueryBuilder('m')
                    ->orderBy('m.date', 'DESC')
                    ->getQuery()
                    ->getResult();
                break;
        }

    }
}
