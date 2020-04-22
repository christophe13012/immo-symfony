<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SearchRepository")
 */
class Search
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxSurface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minSurface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPrice;

    /**
     * @var ArrayCollection
     */
    private $options;


    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMaxSurface(): ?int
    {
        return $this->maxSurface;
    }

    public function setMaxSurface(?int $maxSurface): self
    {
        $this->maxSurface = $maxSurface;

        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(?int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @return ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;
    }
}
