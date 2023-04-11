<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenderRepository::class)]
class Gender
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'gender', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'gender', targetEntity: Accessory::class, orphanRemoval: true)]
    private Collection $accessories;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->accessories = new ArrayCollection();
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setGender($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getGender() === $this) {
                $product->setGender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Accessory>
     */
    public function getAccessories(): Collection
    {
        return $this->accessories;
    }

    public function addAccessory(Accessory $accessory): self
    {
        if (!$this->accessories->contains($accessory)) {
            $this->accessories->add($accessory);
            $accessory->setGender($this);
        }

        return $this;
    }

    public function removeAccessory(Accessory $accessory): self
    {
        if ($this->accessories->removeElement($accessory)) {
            // set the owning side to null (unless already changed)
            if ($accessory->getGender() === $this) {
                $accessory->setGender(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
