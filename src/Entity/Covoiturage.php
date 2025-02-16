<?php

namespace App\Entity;

use App\Repository\CovoiturageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CovoiturageRepository::class)]
class Covoiturage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_depart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $heure_depart = null;

    #[ORM\Column(length: 64)]
    private ?string $lieu_depart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_arrivee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $heure_arrivee = null;

    #[ORM\Column(length: 64)]
    private ?string $lieu_arrive = null;

    #[ORM\Column(length: 64)]
    private ?string $statut = null;

    #[ORM\Column]
    private ?int $nb_place = null;

    #[ORM\Column]
    private ?float $prix_personne = null;

    /**
     * @var Collection<int, voiture>
     */
    #[ORM\OneToMany(targetEntity: voiture::class, mappedBy: 'covoiturage')]
    private Collection $voiture;

    #[ORM\ManyToOne(inversedBy: 'covoiturages')]
    private ?utilisateur $utilisateur = null;

    public function __construct()
    {
        $this->voiture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): static
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(\DateTimeInterface $heure_depart): static
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieu_depart;
    }

    public function setLieuDepart(string $lieu_depart): static
    {
        $this->lieu_depart = $lieu_depart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->date_arrivee;
    }

    public function setDateArrivee(\DateTimeInterface $date_arrivee): static
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heure_arrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heure_arrivee): static
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    public function getLieuArrive(): ?string
    {
        return $this->lieu_arrive;
    }

    public function setLieuArrive(string $lieu_arrive): static
    {
        $this->lieu_arrive = $lieu_arrive;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): static
    {
        $this->nb_place = $nb_place;

        return $this;
    }

    public function getPrixPersonne(): ?float
    {
        return $this->prix_personne;
    }

    public function setPrixPersonne(float $prix_personne): static
    {
        $this->prix_personne = $prix_personne;

        return $this;
    }

    /**
     * @return Collection<int, voiture>
     */
    public function getVoiture(): Collection
    {
        return $this->voiture;
    }

    public function addVoiture(voiture $voiture): static
    {
        if (!$this->voiture->contains($voiture)) {
            $this->voiture->add($voiture);
            $voiture->setCovoiturage($this);
        }

        return $this;
    }

    public function removeVoiture(voiture $voiture): static
    {
        if ($this->voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getCovoiturage() === $this) {
                $voiture->setCovoiturage(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
