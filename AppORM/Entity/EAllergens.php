<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
<<<<<<< Updated upstream
use Doctrine\Common\Collections\ArrayCollection;
=======
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
    
=======
>>>>>>> Stashed changes
    /**
     * @var Collection<int, EProduct>
     */
    #[ORM\ManyToMany(targetEntity: EProduct::class, mappedBy: 'allergens')]
<<<<<<< Updated upstream
    private Collection $products;
=======
    private Collection $product;
>>>>>>> Stashed changes

    public function __construct(string $allergenType)
    {
        $this->allergenType = $allergenType;
<<<<<<< Updated upstream
        // Inizializza la collezione come un array vuoto.
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getAllergenType(): string { return $this->allergenType; }
    public function setAllergenType(string $type): void { $this->allergenType = $type; }


    /**
     * @return Collection<int, EProduct>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * Metodo di supporto chiamato da EProduct.addAllergen()
     * per mantenere la coerenza.
     */
    public function addProduct(EProduct $product): void
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }
    }

    /**
     * Metodo di supporto chiamato da EProduct.removeAllergen()
     */
    public function removeProduct(EProduct $product): void
    {
        $this->products->removeElement($product);
    }
}
=======
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
>>>>>>> Stashed changes
