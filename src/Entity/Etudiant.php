<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=50)
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     * @Assert\Length(
     *      min = 3,
     *      max = 25,
     *      minMessage = "Votre prénom doit contenir au moins plus de 3 caractères",
     *      maxMessage = "Votre prénom ne doit pas dépasser les {{limit}} caractères ",
     *      allowEmptyString = false
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     *      @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "Votre nom doit contenir au moins {{limit}} caractères",
     *      maxMessage = "Votre nom ne doit pas dépasser les {{limit}} caractères ",
     *      allowEmptyString = false
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     *  * @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     *  @Assert\Email(
     *     message = "La valeur du champ e-mai n'est pas un e-mail valide."
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\NotBlank(message="Le champs ne doit pas être vide.")
     * @Assert\Regex("/^[7][0|7|8|6]([0-9]{7})$/", message="Entrez un numero de Telephone valide")
     */
    private $telephone;

    /**
     * @ORM\Column(type="text", nullable=true)
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     */
    private $typeEtudiant;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     */
    private $typeBourse;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="etudiants")
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     */
    private $numChambre;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="etudiants")
     *  @Assert\NotBlank(message="Le champs ne doit pas etre vide")
     */
    private $nomDepartement;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTypeEtudiant(): ?string
    {
        return $this->typeEtudiant;
    }

    public function setTypeEtudiant(string $typeEtudiant): self
    {
        $this->typeEtudiant = $typeEtudiant;

        return $this;
    }

    public function getTypeBourse(): ?string
    {
        return $this->typeBourse;
    }

    public function setTypeBourse(?string $typeBourse): self
    {
        $this->typeBourse = $typeBourse;

        return $this;
    }

    public function getNumChambre(): ?Chambre
    {
        return $this->numChambre;
    }

    public function setNumChambre(?Chambre $numChambre): self
    {
        $this->numChambre = $numChambre;

        return $this;
    }

    public function getNomDepartement(): ?Departement
    {
        return $this->nomDepartement;
    }

    public function setNomDepartement(?Departement $nomDepartement): self
    {
        $this->nomDepartement = $nomDepartement;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
