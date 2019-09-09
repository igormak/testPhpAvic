<?php

namespace Main\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="territory", type="string", length=250, nullable=true)
     */
    private $territory;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set territory
     *
     * @param string $territory
     * @return Users
     */
    public function setTerritory($territory)
    {
        $this->territory = $territory;
    
        return $this;
    }

    /**
     * Get territory
     *
     * @return string 
     */
    public function getTerritory()
    {
        return $this->territory;
    }


    public function exchangeArray($data)
    {
        foreach($data as $key => $val){
            if(property_exists($this, $key)){
                $this->$key = ($val !== null) ? $val : null;
            }
        }
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
