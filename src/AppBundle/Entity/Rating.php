<?php
// src/AppBundle/Entity/Rating.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="rating")
 */
class Rating
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $ratingId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $rating;

    /**
     * @ORM\Column(type="integer", length=16)
     */
    private $tstamp;

    /**
     * @ORM\Column(type="integer", length=8)
     */
    private $userId;

    /**
     * @ORM\Column(type="integer", length=8)
     */
    private $postId;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $ip;

    /**
     * @return mixed
     */
    public function getRatingId()
    {
        return $this->ratingId;
    }

    /**
     * @param mixed $ratinId
     */
    public function setRatingId($ratingId)
    {
        $this->ratingId = $ratingId;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @param mixed $tstamp
     */
    public function setTstamp($tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

}