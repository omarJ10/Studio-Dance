<?php

namespace App\Entity;

use App\Repository\DomaineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomaineRepository::class)
 */
class Domaine
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
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Coach::class, mappedBy="domaine")
     */
    private $id_coach;

    public function __construct()
    {
        $this->id_coach = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Coach>
     */
    public function getIdCoach(): Collection
    {
        return $this->id_coach;
    }

    public function addIdCoach(Coach $idCoach): self
    {
        if (!$this->id_coach->contains($idCoach)) {
            $this->id_coach[] = $idCoach;
            $idCoach->setDomaine($this);
        }

        return $this;
    }

    public function removeIdCoach(Coach $idCoach): self
    {
        if ($this->id_coach->removeElement($idCoach)) {
            // set the owning side to null (unless already changed)
            if ($idCoach->getDomaine() === $this) {
                $idCoach->setDomaine(null);
            }
        }

        return $this;
    }
}
