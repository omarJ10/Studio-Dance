<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\OneToMany(targetEntity=Coach::class, mappedBy="offre")
     */
    private $Coach_id;


    public function __construct()
    {
        $this->Coach_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }
    


    public function setDateFin(\DateTimeInterface $date)
    {
        $this->date_fin = $date;
    }

    /**
     * @return Collection<int, Coach>
     */
    public function getCoachId(): Collection
    {
        return $this->Coach_id;
    }

    public function addCoachId(Coach $coachId): self
    {
        if (!$this->Coach_id->contains($coachId)) {
            $this->Coach_id[] = $coachId;
            $coachId->setOffre($this);
        }

        return $this;
    }

    public function removeCoachId(Coach $coachId): self
    {
        if ($this->Coach_id->removeElement($coachId)) {
            // set the owning side to null (unless already changed)
            if ($coachId->getOffre() === $this) {
                $coachId->setOffre(null);
            }
        }

        return $this;
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return  (string) $this->id;
    }
}
