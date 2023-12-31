<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
     * @ORM\ManyToOne(targetEntity=client::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=cours::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $cours;
    /**
    * @ORM\Column(type="boolean",nullable=true)
    */
   private $paye;

    /**
     * @ORM\ManyToOne(targetEntity=offre::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $offre;

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
    public function getPaiement(): ?bool
    {
        return $this->paye;
    }
    public function setPaiement(bool $paye): self
    {
        $this->paye = $paye;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCours(): ?cours
    {
        return $this->cours;
    }

    public function setCours(?cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    public function getOffre(): ?offre
    {
        return $this->offre;
    }

    public function setOffre(?offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }
}
