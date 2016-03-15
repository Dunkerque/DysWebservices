<?php

namespace Webservice\MainBundle\Repository;

/**
 * AddressRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AddressRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAdressUser($user)
    {

        $qb = $this ->createQueryBuilder('a');
        $qb ->where('a.idUser = :idUser')
            ->setParameter('idUser',$user);

        $resultat =$qb->getQuery() ;
        return $resultat->getResult();

    }
}