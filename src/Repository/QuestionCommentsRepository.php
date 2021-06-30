<?php

namespace App\Repository;

use App\Entity\QuestionComments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionComments[]    findAll()
 * @method QuestionComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionCommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionComments::class);
    }

    // /**
    //  * @return QuestionComments[] Returns an array of QuestionComments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionComments
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getQuestionComment($id)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.question = :val')
            ->setParameter('val', $id)
            ->orderBy('a.id','DESC');
        $query = $qb->getQuery();
        return $query->execute();
    }
}
