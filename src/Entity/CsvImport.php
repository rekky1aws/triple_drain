<?php

namespace App\Entity;

use App\Repository\CsvImportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CsvImportRepository::class)]
class CsvImport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $importedAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $importedBy = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column]
    private ?bool $usable = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImportedAt(): ?\DateTimeImmutable
    {
        return $this->importedAt;
    }

    public function setImportedAt(\DateTimeImmutable $importedAt): static
    {
        $this->importedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getImportedBy(): ?User
    {
        return $this->importedBy;
    }

    public function setImportedBy(?User $importedBy): static
    {
        $this->importedBy = $importedBy;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function isUsable(): ?bool
    {
        return $this->usable;
    }

    public function setUsable(bool $usable): static
    {
        $this->usable = $usable;

        return $this;
    }
}
