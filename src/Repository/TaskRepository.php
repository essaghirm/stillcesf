<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }

//    /**
//     * @return Task[] Returns an array of Task objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Task
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Task[] Returns an array of Task objects
     */
    public function what($what, $user = null)
    {

        $em = $this->getEntityManager();

        
        switch ($what) {
            case 'attachedToMe':
                return $this->createQueryBuilder('t')
                    ->andWhere('t.attachedTo = :val')
                    ->setParameter('val', $user)
                    ->orderBy('t.date', 'ASC')
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
                return  $this->createQueryBuilder('t')
                    ->andWhere('t.project in (:val)')
                    ->setParameter('val', $projects)
                    ->orderBy('t.date', 'ASC')
                    ->getQuery()
                    ->getResult();
                // dump($tasks);die;
            break;
            
            default:
                return $this->findAll();
                break;
        }

    }
}
