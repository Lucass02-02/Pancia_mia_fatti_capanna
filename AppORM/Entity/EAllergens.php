<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'allergens')]
class EAllergens
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private string $allergenType;

    /**
     * @var Collection<int, EProduct>
     */
    #[ORM\ManyToMany(targetEntity: EProduct::class, mappedBy: 'allergens')]
    private Collection $product;

    public function __construct(string $allergenType)
    {
        $this->allergenType = $allergenType;
        $this->product = new ArrayCollection();
    }

    // --- METODO GETTER MANCANTE ---
    /**
     * Restituisce l'ID dell'allergene.
     * Questo è il metodo che mancava e che causava l'errore.
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    // -----------------------------

    public function getAllergenType(): string
    {
        return $this->allergenType;
    }

    public function setAllergenType(string $allergenType): void
    {
        $this->allergenType = $allergenType;
    }

    public function getProduct(): Collection 
    {
        return $this->product;
    }
}