<?php
// src/AppBundle/Entity/Artist.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artist")
 */
class Artist
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $artistId;

    /**
     * @ORM\Column(type="string", length=100)
     *
     */
    private $artist;

    /**
     * @ORM\Column(type="text")
     */
    private $bio;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="artist")
     */
    private $posts;

    /**
     * @return mixed
     */
    public function getArtistId()
    {
        return $this->artistId;
    }

    /**
     * @param mixed $artistId
     */
    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    public function __toString()
    {
        return $this->getArtist();
    }
}