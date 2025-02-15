<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'prefectures')]
class Prefecture
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private int $id;

  #[ORM\Column(type: 'string', length: 4)]
  private string $name;

  #[ORM\OneToMany(targetEntity: 'Population', mappedBy: 'prefecture')]
  private Collection $populations;

  // Getters and setters
  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getPopulations(): Collection
  {
    return $this->populations;
  }

  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
    ];
  }
}
