<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class PostImage
{
    private $doctrine;

    function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getIsFirst($postId)
    {
        $repository = $this->doctrine->getRepository('AppBundle:Image');
        $images = $repository->findBy( array('postId' => $postId) );
        return count($images);
    }
}