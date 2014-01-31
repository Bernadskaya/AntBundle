<?php
/**
 * Created by PhpStorm.
 * User: nevada
 * Date: 07.01.14
 * Time: 14:39
 */


namespace Ant\Bundle\Entity;

use Doctrine\ORM\EntityRepository;


class AdRepository extends EntityRepository{

    public function findByAdGroup($id)
    {
        $dql = "SELECT a FROM AntBundle:Ad a WHERE a.adGroup = ?1 ORDER BY a.position ASC";
        return $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $id)
            ->getResult();
    }

}