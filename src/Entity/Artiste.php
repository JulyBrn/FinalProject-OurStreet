<?php

namespace App\Entity;

use App\Entity\Artwork;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtisteRepository")
 */
class Artiste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artwork", mappedBy="artistes")
     */
    private $artworks;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="follow")
     */
    private $follower;

   

    public function __construct()
    {
        $this->artworks = new ArrayCollection();
        $this->follower = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Artwork[]
     */
    public function getArtworks(): Collection
    {
        return $this->artworks;
    }

    public function addArtwork(Artwork $artwork): self
    {
        if (!$this->artworks->contains($artwork)) {
            $this->artworks[] = $artwork;
            $artwork->addArtiste($this);
        }

        return $this;
    }

    public function removeArtwork(Artwork $artwork): self
    {
        if ($this->artworks->contains($artwork)) {
            $this->artworks->removeElement($artwork);
            $artwork->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getFollower(): Collection
    {
        return $this->follower;
    }

    public function addFollower(User $follower): self
    {
        if (!$this->follower->contains($follower)) {
            $this->follower[] = $follower;
            $follower->addFollow($this);
        }

        return $this;
    }

    public function removeFollower(User $follower): self
    {
        if ($this->follower->contains($follower)) {
            $this->follower->removeElement($follower);
            $follower->removeFollow($this);
        }

        return $this;
    }
}
