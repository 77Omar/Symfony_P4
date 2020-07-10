<?php

namespace App\Entity;


use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     */
    private $numChambre;


    /**
     * @ORM\ManyToOne(targetEntity=Batiment::class, inversedBy="chambres")
     */
    private $numBatiment;
    public function __toString()
    {
        return (string) $this->numBatiment;
    }

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="numChambre")
     */
    private $etudiants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeChambre;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumChambre(): ?string
    {
        return $this->numChambre;
    }

    public function setNumChambre(string $numChambre): self
    {
        $this->numChambre = $numChambre;

        return $this;
    }

    public function getNumBatiment(): ?Batiment
    {
        return $this->numBatiment;
    }

    public function setNumBatiment(?Batiment $numBatiment): self
    {
        $this->numBatiment = $numBatiment;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setNumChambre($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getNumChambre() === $this) {
                $etudiant->setNumChambre(null);
            }
        }

        return $this;
    }

    public function getTypeChambre(): ?string
    {
        return $this->typeChambre;
    }

    public function setTypeChambre(string $typeChambre): self
    {
        $this->typeChambre = $typeChambre;

        return $this;
    }
}
