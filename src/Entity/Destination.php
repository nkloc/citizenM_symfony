<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 */
class Destination
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Location;

    /**
     * @ORM\OneToMany(targetEntity=Hotel::class, mappedBy="destination")
     */
    private $Hotels;

    public function __construct()
    {
        $this->Hotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    /**
     * @return Collection|Hotel[]
     */
    public function getHotels(): Collection
    {
        return $this->Hotels;
    }

    public function addHotel(Hotel $hotel): self
    {
        if (!$this->Hotels->contains($hotel)) {
            $this->Hotels[] = $hotel;
            $hotel->setDestination($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): self
    {
        if ($this->Hotels->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getDestination() === $this) {
                $hotel->setDestination(null);
            }
        }

        return $this;
    }
}
