<?php
namespace App\Entity;

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
}