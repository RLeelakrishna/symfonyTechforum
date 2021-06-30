<?php

namespace App\Repository;

use App\Entity\AnswerComments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnswerComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnswerComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnswerComments[]    findAll()
 * @method AnswerComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerCommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnswerComments::class);
    }

    // /**
    //  * @return AnswerComments[] Returns an array of AnswerComments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnswerComments
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
//    */
//    public function getComment($answer_id)
//    {
//        $qb = $this->createQueryBuilder('a')
//            ->andWhere('a.id = :val')
//            ->setParameter('val', $answer_id)
//            ->orderBy('a.id','DESC');
//            $query = $qb->getQuery();
//            return $query->execute();
//    }

      public function  getComment(){
          $dql = 'SELECT comment FROM App\Entity\AnswerComments  comment ';
          $query = $this->getEntityManager()->createQuery($dql);
//          var_dump($query->getSQL());

          return $query->execute();
      }

}
