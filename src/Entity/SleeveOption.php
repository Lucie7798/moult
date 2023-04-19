<?php

namespace App\Entity;

use App\Repository\SleeveOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SleeveOptionRepository::class)]
class SleeveOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sleeveOptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $jacket = null;

    #[ORM\ManyToOne(inversedBy: 'sleeveOptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $sleeve = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJacket(): ?Product
    {
        return $this->jacket;
    }

    public function setJacket(?Product $jacket): self
    {
        $this->jacket = $jacket;

        return $this;
    }

    public function getSleeve(): ?Product
    {
        return $this->sleeve;
    }

    public function setSleeve(?Product $sleeve): self
    {
        $this->sleeve = $sleeve;

        return $this;
    }
}
