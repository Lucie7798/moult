<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    use TimestampableEntity;

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

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gender $gender = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductImage::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Assert\Valid()]
    private Collection $productImages;

    #[ORM\Column]
    private ?bool $isAccessory = false;

    #[ORM\OneToMany(mappedBy: 'jacket', targetEntity: SleeveOption::class, orphanRemoval: true)]
    private Collection $sleeveOptions;

    #[ORM\ManyToMany(targetEntity: Size::class, inversedBy: 'products')]
    #[ORM\JoinTable(name: "product_size")]
    private Collection $sizes;

    #[ORM\ManyToMany(targetEntity: Color::class, inversedBy: 'products')]
    #[ORM\JoinTable(name: "product_color")]
    private Collection $colors;

    public function __construct()
    {
        $this->productImages = new ArrayCollection();
        $this->sleeveOptions = new ArrayCollection();
        $this->sizes = new ArrayCollection();
        $this->colors = new ArrayCollection();
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
     * @return Collection<int, ProductImage>
     */
    public function getProductImages(): Collection
    {
        return $this->productImages;
    }

    public function addProductImage(ProductImage $productImage): self
    {
        if (!$this->productImages->contains($productImage)) {
            $this->productImages->add($productImage);
            $productImage->setProduct($this);
        }

        return $this;
    }

    public function removeProductImage(ProductImage $productImage): self
    {
        if ($this->productImages->removeElement($productImage)) {
            // set the owning side to null (unless already changed)
            if ($productImage->getProduct() === $this) {
                $productImage->setProduct(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function isIsAccessory(): ?bool
    {
        return $this->isAccessory;
    }

    public function setIsAccessory(?bool $isAccessory): self
    {
        $this->isAccessory = $isAccessory;

        return $this;
    }

    /**
     * @return Collection<int, SleeveOption>
     */
    public function getSleeveOptions(): Collection
    {
        return $this->sleeveOptions;
    }

    public function addSleeveOption(SleeveOption $sleeveOption): self
    {
        if (!$this->sleeveOptions->contains($sleeveOption)) {
            $this->sleeveOptions->add($sleeveOption);
            $sleeveOption->setJacket($this);
        }

        return $this;
    }

    public function removeSleeveOption(SleeveOption $sleeveOption): self
    {
        if ($this->sleeveOptions->removeElement($sleeveOption)) {
            // set the owning side to null (unless already changed)
            if ($sleeveOption->getJacket() === $this) {
                $sleeveOption->setJacket(null);
            }
        }

        return $this;
    }

    public function getSizes(): Collection
    {
        return $this->sizes;
    }

    public function addSize(Size $size): self
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes->add($size);
            $size->addProduct($this);
        }

        return $this;
    }

    public function removeSize(Size $size): self
    {
        if ($this->sizes->removeElement($size)) {
            $size->removeProduct($this);
        }

        return $this;
    }

    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors->add($color);
            $color->addProduct($this);
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        if ($this->colors->removeElement($color)) {
            $color->removeProduct($this);
        }

        return $this;
    }
}
