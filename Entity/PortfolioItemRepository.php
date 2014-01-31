<?php
/**
 * Created by PhpStorm.
 * User: nevada
 * Date: 08.01.14
 * Time: 19:15
 */

namespace Ant\Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class PortfolioItemRepository extends EntityRepository {


    public function findByPortfolioId($portfolio_id)
    {
        $dql = "SELECT a FROM AntBundle:PortfolioItem a WHERE a.portfolioId = ?1";
        return $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $portfolio_id)
            ->getResult();
    }

}