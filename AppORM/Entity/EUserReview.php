<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppORM\Entity\EClient;
use AppORM\Entity\EAdminResponse;


#[ORM\Entity]
#[ORM\Table(name: 'user_reviews')]
class EUserReview
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'reviews')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private EClient $client;

    #[ORM\Column(type: 'text')]
    private string $comment;

    #[ORM\Column(type: 'integer')]
    private int $rating;

    #[ORM\Column(type: 'datetime')]
    private DateTime $reviewDate;

    #[ORM\OneToMany(targetEntity: EAdminResponse::class, mappedBy: 'userReview', cascade: ['persist', 'remove'], orphanRemoval: true)] // Aggiungi 'remove' e 'orphanRemoval' per eliminare le risposte con la recensione
    private Collection $adminResponses;

    public function __construct(EClient $client, string $comment, int $rating)
    {
        $this->client = $client;
        $this->comment = $comment;
        $this->setRating($rating); // Usa il setter per la validazione
        $this->reviewDate = new DateTime();
        $this->adminResponses = new ArrayCollection(); // Inizializza la collezione
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getClient(): EClient
    {
        return $this->client;
    }
    public function getComment(): string
    {
        return $this->comment;
    }
    public function getRating(): int
    {
        return $this->rating;
    }
    public function getReviewDate(): DateTime
    {
        return $this->reviewDate;
    }

    public function setRating(int $rating): void
    {
        if ($rating < 1 || $rating > 5) {
            throw new \InvalidArgumentException("Il voto deve essere compreso tra 1 e 5.");
        }
        $this->rating = $rating;
    }

    public function getCreationDate(): DateTime
    {
        return $this->reviewDate;
    }
        public function getAdminResponses(): Collection
    {
        return $this->adminResponses;
    }

    public function addAdminResponse(EAdminResponse $adminResponse): void
    {
        if (!$this->adminResponses->contains($adminResponse)) {
            $this->adminResponses->add($adminResponse);
            $adminResponse->setUserReview($this);
        }
    }

    public function removeAdminResponse(EAdminResponse $adminResponse): void
    {
        if ($this->adminResponses->contains($adminResponse)) {
            $this->adminResponses->removeElement($adminResponse);;
        }
    }


    
    
}