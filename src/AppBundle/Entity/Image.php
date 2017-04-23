<?php
// src/AppBundle/Entity/Image.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="image")
 */
class Image
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $imageId;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Please select an image.")
     * @Assert\File(mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif",
     *      })
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Post")
     */
    private $post;

    /**
     * @ORM\Column(type="integer", length=16)
     */
    private $showDefault;

    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * @param mixed $imageId
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getShowDefault()
    {
        return $this->showDefault;
    }
    /**
     * @param mixed $showDefault
     */
    public function setShowDefault($showDefault)
    {
        $this->showDefault = $showDefault;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
      return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost($post)
    {
      $this->post = $post;
    }

}