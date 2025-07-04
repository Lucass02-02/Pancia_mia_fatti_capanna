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
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    // Questa è la relazione che è stata modificata con cascade: ['persist']
    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'reviews', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private EClient $user;

    #[ORM\Column(type: 'string', length: 255)]
    private string $comment;

    #[ORM\Column(type: 'integer')]
    private int $rating; // Esempio: da 1 a 5

    #[ORM\Column(type: 'datetime')]
    private DateTime $reviewDate;

    // Costruttore
    public function __construct(EClient $user, string $comment, int $rating)
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->rating = $rating;
        $this->reviewDate = new DateTime();
    }

    // Metodi Getter
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): EClient
    {
        return $this->user;
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

    // Metodi Setter
    public function setUser(EClient $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function setReviewDate(DateTime $reviewDate): self
    {
        $this->reviewDate = $reviewDate;
        return $this;
    }
}