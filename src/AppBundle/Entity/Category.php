<?php
// src/AppBundle/Entity/Artist.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category

{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="string", length=100)
     *
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     */
    private $linkUrl;
 
    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->artist = $category;
    }

    /**
     * @return mixed
     */
    public function getLinkUrl()
    {
        return $this->linkUrl;
    }

    /**
     * @param mixed $linkUrl
     */
    public function setLinkUrl($linkUrl)
    {
        $this->linkUrl = $linkUrl;
    } 
}