<?php
// AppORM/Entity/EUserReview.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'user_reviews')]
class EUserReview
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * CORREZIONE: Questa è la relazione inversa.
     * 'inversedBy' punta a 'reviews' (la proprietà in EClient).
     * La colonna nel database si chiamerà 'client_id'.
     */
    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'reviews')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private EClient $client;

    #[ORM\Column(type: 'text')]
    private string $comment;

    #[ORM\Column(type: 'integer')]
    private int $rating;

    #[ORM\Column(type: 'datetime')]
    private DateTime $reviewDate;


    public function __construct(EClient $client, string $comment, int $rating)
    {
        $this->client = $client;
        $this->comment = $comment;
        $this->setRating($rating); // Usa il setter per la validazione
        $this->reviewDate = new DateTime();
    }

    // --- Getters ---
    public function getId(): ?int { return $this->id; }
    public function getClient(): EClient { return $this->client; }
    public function getComment(): string { return $this->comment; }
    public function getRating(): int { return $this->rating; }
    public function getReviewDate(): DateTime { return $this->reviewDate; }

    // --- Setters con validazione ---
    public function setRating(int $rating): void
    {
        if ($rating < 1 || $rating > 5) {
            throw new \InvalidArgumentException("Il voto deve essere compreso tra 1 e 5.");
        }
        $this->rating = $rating;
    }
}