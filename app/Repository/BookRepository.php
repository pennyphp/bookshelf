<?php

namespace ClassicApp\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

class BookRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPaginator()
    {
        $dql = 'SELECT b FROM ClassicApp\Entity\Book b';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setFirstResult(0)
            ->setMaxResults(20);

        $paginator = new Paginator($query, $fetchJoinCollection = true);
        return $paginator;
    }
}