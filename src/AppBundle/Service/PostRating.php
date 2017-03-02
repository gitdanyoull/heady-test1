<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 2/21/17
 * Time: 7:39 PM
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\Request;

class PostRating
{
    private $ip;
    private $postId;

    function __construct($ip,$postId)
    {
        $this->ip = $ip;
        $this->postId = $postId;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getIpMessage($doctrine)
    {
        $rating_repo = $doctrine->getRepository('AppBundle:Message');
        $rating = $rating_repo->findOneBy(array('ip'=>$this->ip,'postId'=>$this->postId));

        if( $rating === null )
            return null;
        else
            return $rating;
    }

    public function getIpRating($doctrine)
    {
       return $this->getRating($doctrine);
    }

    public function getRating($doctrine)
    {
        $message = $this->getIpMessage($doctrine);
        return 3;
    }
}