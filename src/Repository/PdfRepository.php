<?php

namespace App\Repository;

use App\Entity\Pdf;
use App\Entity\User;
use DateInterval;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pdf>
 *
 * @method Pdf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pdf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pdf[]    findAll()
 * @method Pdf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PdfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pdf::class);
    }

    public function countPdfGeneratedByUserOnDate(User $user)
    {
        $startSubscriptionDate = $user->getSubscriptionEndAt()->sub(DateInterval::createFromDateString('1 month'));
        $now = (new \DateTimeImmutable());

        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.owner = :user')
            ->andWhere('p.createdAt BETWEEN :subscriptionStart AND :now')
            ->setParameter('user', $user)
            ->setParameter('subscriptionStart', $startSubscriptionDate)
            ->setParameter('now', $now)
            ->getQuery()
            ->getSingleScalarResult();
    }


    //    /**
    //     * @return Pdf[] Returns an array of Pdf objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Pdf
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
