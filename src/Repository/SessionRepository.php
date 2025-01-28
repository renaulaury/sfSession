<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function findNoRegistered($session_id)
    {
        $entityManager = $this->getEntityManager();
        $sub = $entityManager->createQueryBuilder();

        //queryBuilder : fonction de symfony pour créer une requete
        $queryBuilder = $sub;

        //Sélectionne interns d'une session dont l'i est passé en paramètre
        $queryBuilder->select('i')
            ->from('App\Entity\Intern', 'i')
            ->leftJoin('i.sessions', 'se')
            ->where('se.id = :id');
        
        $sub = $entityManager->createQueryBuilder();
        //Sélectionne interns qui ne sont pas (NOT IN) dans le résultat précédent
        //on obtien interns non inscrits pour une session
        $sub->select('int')
            ->from('App\Entity\Intern', 'int')
            ->where($sub->expr()->notIn('int.id', $queryBuilder->getDQL()))
            //requete paramétrée
            ->setParameter('id', $session_id)
            //trier liste des stagiaires sur le nom de famille
            ->orderBy('int.nameIntern');

        //Renvoie du résultat
        $query = $sub->getQuery();
        return $query->getResult();

    }

    //    /**
    //     * @return Session[] Returns an array of Session objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Session
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
