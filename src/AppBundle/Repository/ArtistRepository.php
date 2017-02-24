<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArtistRepository extends EntityRepository
{
    public function createAlphabeticalQueryBuilder()
    {
        return $this->createQueryBuilder('artist')
            ->orderBy('artist.artist', 'ASC');
    }
}
