<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Artist;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function findAllByPostWithRating()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.id, (SELECT AVG(r.rating) FROM AppBundle:Rating r WHERE r.post=p.id GROUP BY r.post ) FROM AppBundle:Post p'
            )
            ->getResult();
    }
}
