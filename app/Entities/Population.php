<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Entities\Year;
use App\Entities\Prefecture;

#[ORM\Entity]
#[ORM\Table(name: 'populations')]
class Population
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private int $id;

  #[ORM\ManyToOne(targetEntity: 'Year')]
  #[ORM\JoinColumn(name: 'year_id', referencedColumnName: 'id')]
  private Year $year;

  #[ORM\ManyToOne(targetEntity: 'Prefecture')]
  #[ORM\JoinColumn(name: 'prefecture_id', referencedColumnName: 'id')]
  private Prefecture $prefecture;

  #[ORM\Column(type: 'integer', length: 4)]
  private string $value;

  // Getters and setters
  public function getId(): int
  {
    return $this->id;
  }

  public function getYear(): Year
  {
    return $this->year;
  }

  public function setYear(Year $year): void
  {
    $this->year = $year;
  }

  public function getPrefecture(): Prefecture
  {
    return $this->prefecture;
  }

  public function setPrefecture(Prefecture $prefecture): void
  {
    $this->prefecture = $prefecture;
  }

  public function getValue(): string
  {
    return $this->value;
  }

  public function setValue(string $value): void
  {
    $this->value = $value;
  }

  public function toArray(): array
  {
    return [
      'id' => $this->getId(),
      'year' => $this->getYear()->toArray(),
      'prefecture' => $this->getPrefecture()->toArray(),
      'value' => $this->getValue(),
    ];
  }
}
