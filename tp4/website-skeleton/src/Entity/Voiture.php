<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Location::class, mappedBy: 'voiture')]
    private Collection $locations;

    #[ORM\Column(length: 255)]
    private ?string $serie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateMiseEnMarche = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prixJour = null;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setVoiture($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getDateMiseEnMarche(): ?\DateTimeInterface
    {
        return $this->dateMiseEnMarche;
    }

    public function setDateMiseEnMarche(\DateTimeInterface $dateMiseEnMarche): static
    {
        $this->dateMiseEnMarche = $dateMiseEnMarche;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPrixJour(): ?string
    {
        return $this->prixJour;
    }

    public function setPrixJour(string $prixJour): static
    {
        $this->prixJour = $prixJour;

        return $this;
    }
}
