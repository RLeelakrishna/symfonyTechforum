<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\StringType;
use Doctrine\Persistence\ManagerRegistry;
use http\Exception\BadQueryStringException;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    // /**
    //  * @return Question[] Returns an array of Question objects
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
    public function findOneBySomeField($value): ?Question
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param string $query
     * @return int|mixed|string
     */

    public function questionlist(string $query)
    {
        $qb = $this->createQueryBuilder('q');
        $qb
            ->where(
                $qb->expr()->like('q.description', ':query'),
                $qb->expr()->isNotNull('q.description')
            )
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('q.description', 'DESC');
        return $qb
            ->getQuery()
            ->getResult();
    }

//    public function answers()
//    {
//        $qb = $this->createQueryBuilder('a');
//        $qb
//            ->innerJoin('a.description', 'u')
//            ->where(
////                $qb->expr()->like('a.description',':query'),
//
//                $qb->expr()->isNotNull('a.description')
//            )
////            ->setParameter('query' ,'%' .$query. '%')
//
//            ->orderBy('a.description', 'DESC');
//        return $qb
//            ->getQuery()
//            ->getResult();
//    }

    public function getQuestion($id)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.id = :val')
            ->setParameter('val', $id);
        $query = $qb->getQuery();
        return $query->execute();
    }

    public function homequestion()
    {
        $qb = $this->createQueryBuilder('l')
            ->setMaxResults(2)
            ->orderBy('l.id', 'desc');
        $questionList = $qb->getQuery();
        return $questionList->execute();

    }
}