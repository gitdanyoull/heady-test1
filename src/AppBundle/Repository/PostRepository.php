<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Artist;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findHomePage()
    {
      return $this->getEntityManager()
        ->createQuery(
          'SELECT 
            p.id, p.title, p.description, p.price, 
            AVG(r.rating) as rating, images.file as image
          FROM AppBundle:Post p
          LEFT JOIN p.ratings r
          LEFT JOIN p.images images WITH images.showDefault = 1
          GROUP BY p.id
          '
        )
        ->getResult();
    }

    public function findAllByPostWithRating()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.id, (SELECT AVG(r.rating) FROM AppBundle:Rating r WHERE r.post=p.id GROUP BY r.post ) FROM AppBundle:Post p'
            )
            ->getResult();
    }
}
