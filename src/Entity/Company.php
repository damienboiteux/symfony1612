<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    #[Assert\NotBlank(['message' => 'Champ obligatoire'])]
    private ?string $nom = null;

    #[ORM\Column(length: 3)]
    #[Assert\Length([
        'max' => 3,
        'maxMessage' => '3 caractères maximum'
    ])]
    #[Assert\NotBlank(['message' => 'Champ obligatoire'])]
    private ?string $sigle = null;

    #[ORM\Column]
    #[Assert\NotBlank(['message' => 'Champ obligatoire'])]
    private ?int $employes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getEmployes(): ?int
    {
        return $this->employes;
    }

    public function setEmployes(int $employes): self
    {
        $this->employes = $employes;

        return $this;
    }
}
