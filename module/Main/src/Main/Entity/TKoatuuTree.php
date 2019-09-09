<?php

namespace Main\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TKoatuuTree
 *
 * @ORM\Table(name="t_koatuu_tree")
 * @ORM\Entity
 */
class TKoatuuTree
{
    /**
     * @var string
     *
     * @ORM\Column(name="ter_id", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $terId;

    /**
     * @var string
     *
     * @ORM\Column(name="ter_pid", type="string", length=10, nullable=true)
     */
    private $terPid;

    /**
     * @var string
     *
     * @ORM\Column(name="ter_name", type="string", length=96, nullable=false)
     */
    private $terName;

    /**
     * @var string
     *
     * @ORM\Column(name="ter_address", type="string", length=128, nullable=false)
     */
    private $terAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="ter_type_id", type="integer", nullable=false)
     */
    private $terTypeId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ter_level", type="boolean", nullable=false)
     */
    private $terLevel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ter_mask", type="boolean", nullable=false)
     */
    private $terMask;

    /**
     * @var string
     *
     * @ORM\Column(name="reg_id", type="string", length=2, nullable=false)
     */
    private $regId;



    /**
     * Get terId
     *
     * @return string 
     */
    public function getTerId()
    {
        return $this->terId;
    }

    /**
     * Set terPid
     *
     * @param string $terPid
     * @return TKoatuuTree
     */
    public function setTerPid($terPid)
    {
        $this->terPid = $terPid;
    
        return $this;
    }

    /**
     * Get terPid
     *
     * @return string 
     */
    public function getTerPid()
    {
        return $this->terPid;
    }

    /**
     * Set terName
     *
     * @param string $terName
     * @return TKoatuuTree
     */
    public function setTerName($terName)
    {
        $this->terName = $terName;
    
        return $this;
    }

    /**
     * Get terName
     *
     * @return string 
     */
    public function getTerName()
    {
        return $this->terName;
    }

    /**
     * Set terAddress
     *
     * @param string $terAddress
     * @return TKoatuuTree
     */
    public function setTerAddress($terAddress)
    {
        $this->terAddress = $terAddress;
    
        return $this;
    }

    /**
     * Get terAddress
     *
     * @return string 
     */
    public function getTerAddress()
    {
        return $this->terAddress;
    }

    /**
     * Set terTypeId
     *
     * @param integer $terTypeId
     * @return TKoatuuTree
     */
    public function setTerTypeId($terTypeId)
    {
        $this->terTypeId = $terTypeId;
    
        return $this;
    }

    /**
     * Get terTypeId
     *
     * @return integer 
     */
    public function getTerTypeId()
    {
        return $this->terTypeId;
    }

    /**
     * Set terLevel
     *
     * @param boolean $terLevel
     * @return TKoatuuTree
     */
    public function setTerLevel($terLevel)
    {
        $this->terLevel = $terLevel;
    
        return $this;
    }

    /**
     * Get terLevel
     *
     * @return boolean 
     */
    public function getTerLevel()
    {
        return $this->terLevel;
    }

    /**
     * Set terMask
     *
     * @param boolean $terMask
     * @return TKoatuuTree
     */
    public function setTerMask($terMask)
    {
        $this->terMask = $terMask;
    
        return $this;
    }

    /**
     * Get terMask
     *
     * @return boolean 
     */
    public function getTerMask()
    {
        return $this->terMask;
    }

    /**
     * Set regId
     *
     * @param string $regId
     * @return TKoatuuTree
     */
    public function setRegId($regId)
    {
        $this->regId = $regId;
    
        return $this;
    }

    /**
     * Get regId
     *
     * @return string 
     */
    public function getRegId()
    {
        return $this->regId;
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
