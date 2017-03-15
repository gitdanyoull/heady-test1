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

    public function getIsFirst($post)
    {
        $repository = $this->doctrine->getRepository('AppBundle:Image');
        $images = $repository->findBy( array('post' => $post) );
        return count($images);
    }
}