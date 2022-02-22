<?php

namespace App\Entity;

use App\Repository\LocalisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocalisationRepository::class)
 */
class Localisation
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
    private $NomLoc;

    /**
     * @ORM\OneToMany(targetEntity=MaisonHote::class, mappedBy="emplacement")
     */
    private $maisons;

    public function __construct()
    {
        $this->maisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLoc(): ?string
    {
        return $this->NomLoc;
    }

    public function setNomLoc(string $NomLoc): self
    {
        $this->NomLoc = $NomLoc;

        return $this;
    }

    /**
     * @return Collection<int, MaisonHote>
     */
    public function getMaisons(): Collection
    {
        return $this->maisons;
    }

    public function addMaison(MaisonHote $maison): self
    {
        if (!$this->maisons->contains($maison)) {
            $this->maisons[] = $maison;
            $maison->setEmplacement($this);
        }

        return $this;
    }

    public function removeMaison(MaisonHote $maison): self
    {
        if ($this->maisons->removeElement($maison)) {
            // set the owning side to null (unless already changed)
            if ($maison->getEmplacement() === $this) {
                $maison->setEmplacement(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
      return $this->getNomLoc();
    }

}
