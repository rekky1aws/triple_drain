<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    /**
     * @var Collection<int, Pinball>
     */
    #[ORM\OneToMany(targetEntity: Pinball::class, mappedBy: 'category')]
    private Collection $pinballs;

    public function __construct()
    {
        $this->pinballs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Pinball>
     */
    public function getPinballs(): Collection
    {
        return $this->pinballs;
    }

    public function addPinball(Pinball $pinball): static
    {
        if (!$this->pinballs->contains($pinball)) {
            $this->pinballs->add($pinball);
            $pinball->setCategory($this);
        }

        return $this;
    }

    public function removePinball(Pinball $pinball): static
    {
        if ($this->pinballs->removeElement($pinball)) {
            // set the owning side to null (unless already changed)
            if ($pinball->getCategory() === $this) {
                $pinball->setCategory(null);
            }
        }

        return $this;
    }
}
