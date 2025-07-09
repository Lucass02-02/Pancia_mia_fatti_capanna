<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection; // Importa ArrayCollection
use DateTime; // Importa DateTime per il tipo di responseDate

#[ORM\Entity]
#[ORM\Table(name: 'admin_responses')]
class EAdminResponse
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private ?int $id = null; // Assicurati che sia nullable e di tipo int

    #[ORM\Column(type: 'text', nullable: false)]
    private string $responseText;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private DateTime $responseDate; // Assicurati che sia di tipo DateTime

    #[ORM\ManyToOne(targetEntity: EAdmin::class, inversedBy: 'responses', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'admin_id', referencedColumnName: 'id')]
    private EAdmin $admin;

    #[ORM\ManyToOne(targetEntity: EUserReview::class, inversedBy: 'adminResponses')] // 'adminResponses' corrisponde alla proprietà Collection in EUserReview
    #[ORM\JoinColumn(name: 'review_id', referencedColumnName: 'id', nullable: false)] // Aggiunge la colonna review_id direttamente nella tabella admin_responses
    private EUserReview $userReview;

    public function __construct(string $responseText, DateTime $responseDate) // Usa DateTime per il parametro
    {
        $this->responseText = $responseText;
        $this->responseDate = $responseDate;
    }

    public static function getEntity()
    {
        return self::$entity;
    }

    public function getId(): ?int // Metodo getter per $id, non getIdResponse
    {
        return $this->id;
    }

    public function getResponseText(): string
    {
        return $this->responseText;
    }

    public function setResponseText(string $responseText)
    {
        $this->responseText = $responseText;
    }

    public function getResponseDate(): DateTime // Metodo getter per $responseDate
    {
        return $this->responseDate;
    }

    public function setResponseDate(DateTime $responseDate) // Metodo setter per $responseDate
    {
        $this->responseDate = $responseDate;
    }

    public function getAdmin(): EAdmin
    {
        return $this->admin;
    }

    public function setAdmin(EAdmin $admin)
    {
        $this->admin = $admin;
    }
      public function getUserReview(): EUserReview 
    {
        return $this->userReview;
    }

    public function setUserReview(EUserReview $userReview): void 
    {
        $this->userReview = $userReview;
    }


    
    public function addUserReview(EUserReview $userReview): void
    {
        if (!$this->userReviews->contains($userReview)) {
            $this->userReviews->add($userReview);
            // Non è necessario chiamare $userReview->addAdminResponse($this); qui
            // perché il mapping è gestito dal lato di EUserReview.
        }
    }
}