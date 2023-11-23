<?php

namespace App\Entity;

use App\Repository\CoachRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CoachRepository::class)
 */
class Coach
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="float")
     */
    private $salaire;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="Coach", orphanRemoval=true)
     */
    private $cours;



    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class, inversedBy="coaches")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\JoinColumn(name="domaine", referencedColumnName="id")
     */
    private $domaine_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Offre::class, inversedBy="coaches")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\JoinColumn(name="offre", referencedColumnName="id")
     */
    private $offre_id;



    public function __construct()
    {
        $this->cours = new ArrayCollection();

        //$this->offre_id = new ArrayCollection();
        $this->offre_id = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffreId(): ?Offre
    {
        return $this->offre_id;
    }



    public function setoffreId(?Offre $offre): self

    {
        $this->offre_id = $offre;

        return $this;
    }
    public function __toString()
    {
        return $this->prenom . " " . $this->nom;    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    public function getNom()
    {
        return $this->nom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setCoach($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getCoach() === $this) {
                $cour->setCoach(null);
            }
        }

        return $this;
    }

    public function getDomaineId(): ?Domaine
    {
        return $this->domaine_id;
    }

    public function setDomaineId(?Domaine $domaine): self
    {
        $this->domaine_id = $domaine;
        return $this;
    }
    
    

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }




}
