<?php

namespace App\Entity;

use App\Repository\ItemImageRepository;
use App\Validator\Constraints\AtLeastOneRelation;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemImageRepository::class)]

class ItemImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'itemImages')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'itemImages')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Accessory $accessory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAccessory(): ?Accessory
    {
        return $this->accessory;
    }

    public function setAccessory(?Accessory $accessory): self
    {
        $this->accessory = $accessory;

        return $this;
    }

    public function __toString()
    {
        return $this->path;
    }
}
