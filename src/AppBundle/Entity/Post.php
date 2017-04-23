<?php
// src/AppBundle/Entity/Product.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * @ORM\Table(name="post")
 */
class Post
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="post", orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="image_id")
     * @ORM\OrderBy({"show_default" = "DESC"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id") 
     */
    private $category;

    /**
     * @ORM\Column(type="date")
     */
    private $purchaseDate;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=2)
     */
    private $price;

    /** 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Artist", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(name="artist", referencedColumnName="artist_id")
     */
    private $artist;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rating", mappedBy="post", orphanRemoval=true)
     * @ORM\JoinColumn(name="rating_id", referencedColumnName="rating_id")
     */
    private $ratings;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
      return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage($image)
    {
      $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * @param mixed $purchaseDate
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $userId
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
  public function getImages() {
    return $this->images;
  }

  /**
   * @param mixed $images
   */
  public function setImages($images) {
    $this->images = $images;
  }

  /**
   * @return mixed
   */
  public function getCategory() {
    return $this->category;
  }

  /**
   * @param mixed $category
   */
  public function setCategory($category) {
    $this->category = $category;
  }
}