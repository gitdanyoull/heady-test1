<?php
// src/AppBundle/Entity/State.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="State")
 */
class State
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $stateId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $state;


    /**
     * @return mixed
     */
    public function getStateId()
    {
        return $this->StateId;
    }

    /**
     * @param mixed $ratinId
     */
    public function setStateId($StateId)
    {
        $this->StateId = $StateId;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->State;
    }

    /**
     * @param mixed $State
     */
    public function setState($State)
    {
        $this->State = $State;
    }

    
}