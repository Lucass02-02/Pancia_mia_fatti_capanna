<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'user_reviews')]
class EUserReview
{
    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'text', nullable: false)]
    private $description;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $vote;

    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    #[ORM\Column(type: 'time', nullable: false)]
    private $hour;

    // Collegato a EClient con eliminazione a cascata
    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'reviews')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')] // AGGIUNTO: onDelete: 'CASCADE'
    private EClient $user; // Deve essere di tipo EClient

    #[ORM\ManyToMany(targetEntity: EAdminResponse::class, inversedBy: 'user_reviews')]
    #[ORM\JoinTable(name: 'user_review_responses')]
    private Collection $adminResponses;

    // Costruttore
    // Ho aggiunto EClient $user come parametro obbligatorio per la relazione ManyToOne
    public function __construct(EClient $user, $description, $vote, $date, $hour)
    {
        $this->user = $user;
        $this->description = $description;
        $this->vote = $vote;
        $this->date = $date;
        $this->hour = $hour;
        $this->adminResponses = new ArrayCollection();
    }

    // Metodi getters e setters
    public function getId()
    {
        return $this->id;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getVote()
    {
        return $this->vote;
    }

    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    public function getUser(): EClient // Getter per l'oggetto EClient associato
    {
        return $this->user;
    }

    public function setUser(EClient $user): self // Setter per l'oggetto EClient associato
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Collection<int, EAdminResponse>
     */
    public function getAdminResponses(): Collection
    {
        return $this->adminResponses;
    }

    public function addAdminResponse(EAdminResponse $adminResponse): self
    {
        if (!$this->adminResponses->contains($adminResponse)) {
            $this->adminResponses->add($adminResponse);
        }
        return $this;
    }

    public function removeAdminResponse(EAdminResponse $adminResponse): self
    {
        $this->adminResponses->removeElement($adminResponse);
        return $this;
    }
}
