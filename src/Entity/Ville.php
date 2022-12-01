<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $nom = null;

    #[ORM\Column(length: 2)]
    private ?string $departement = null;

    #[ORM\Column]
    private ?int $population = null;

    #[ORM\OneToMany(mappedBy: 'ville', targetEntity: Aeroport::class)]
    private Collection $aeroports;

    public function __construct()
    {
        $this->aeroports = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

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

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    /**
     * @return Collection<int, Aeroport>
     */
    public function getAeroports(): Collection
    {
        return $this->aeroports;
    }

    public function addAeroport(Aeroport $aeroport): self
    {
        if (!$this->aeroports->contains($aeroport)) {
            $this->aeroports->add($aeroport);
            $aeroport->setVille($this);
        }

        return $this;
    }

    public function removeAeroport(Aeroport $aeroport): self
    {
        if ($this->aeroports->removeElement($aeroport)) {
            // set the owning side to null (unless already changed)
            if ($aeroport->getVille() === $this) {
                $aeroport->setVille(null);
            }
        }

        return $this;
    }
}
