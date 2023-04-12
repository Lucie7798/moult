<?php

namespace App\Entity;

use App\Repository\AccessoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessoryRepository::class)]
class Accessory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'accessories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'accessories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gender $gender = null;

    #[ORM\OneToMany(mappedBy: 'accessory', targetEntity: ItemImage::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $itemImages;

    public function __construct()
    {
        $this->itemImages = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, ItemImage>
     */
    public function getItemImages(): Collection
    {
        return $this->itemImages;
    }

    public function addItemImage(ItemImage $itemImage): self
    {
        if (!$this->itemImages->contains($itemImage)) {
            $this->itemImages->add($itemImage);
            $itemImage->setAccessory($this);
        }

        return $this;
    }

    public function removeItemImage(ItemImage $itemImage): self
    {
        if ($this->itemImages->removeElement($itemImage)) {
            // set the owning side to null (unless already changed)
            if ($itemImage->getAccessory() === $this) {
                $itemImage->setAccessory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
