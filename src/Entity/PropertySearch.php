<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
class PropertySearch{

     /**
     * @var integer|null
     */
    private $maxPrice;
    
    /**
     * @var integer|null
     * @Assert\Range(min=40, max=400)
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $options;

    /**
     * @var int|null
     */
    private $distance;
    /**
     * @var float|null
     */    
    private $lat;
    /**
     * @var float|null
     */
    private $lng;

     /**
     * @var string|null
     */
    private $address;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * Get the value of maxPrice
     *
     * @return  integer|null
     */ 
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @param  integer|null  $maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice(int $maxPrice):PropertySearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get the value of minSurface
     *
     * @return  integer|null
     */ 
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @param  integer|null  $minSurface
     *
     * @return  self
     */ 
    public function setMinSurface(int $minSurface) : PropertySearch
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of options
     *
     * @return  ArrayCollection
     */ 
    public function getOptions() : ArrayCollection
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @param  ArrayCollection  $options
     *
     * @return  self
     */ 
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }

    /**
     * Get the value of distance
     *
     * @return  int|null
     */ 
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set the value of distance
     *
     * @param  int|null  $distance
     *
     * @return  self
     */ 
    public function setDistance(?int $distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get the value of lat
     */ 
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @return  self
     */ 
    public function setLat(?float $lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of lng
     *
     * @return  float|null
     */ 
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set the value of lng
     *
     * @param  float|null  $lng
     *
     * @return  self
     */ 
    public function setLng(?float $lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get the value of address
     *
     * @return  string|null
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string|null  $address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}