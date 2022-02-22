<?php

namespace App\Entity;

use App\Repository\MaisonHoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaisonHoteRepository::class)
 */
class MaisonHote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\ManyToOne(targetEntity=Localisation::class, inversedBy="maisons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $emplacement;

    /**
     * @ORM\Column(type="float")
     */
    private $Prixnuit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getEmplacement(): ?Localisation
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Localisation $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getPrixnuit(): ?float
    {
        return $this->Prixnuit;
    }

    public function setPrixnuit(float $Prixnuit): self
    {
        $this->Prixnuit = $Prixnuit;

        return $this;
    }
}
