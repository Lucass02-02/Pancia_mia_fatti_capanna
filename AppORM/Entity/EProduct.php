<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection; // Aggiunto per ArrayCollection

enum ProductCategory: string {
    case ANTIPASTO = 'antipasto';
    case PRIMO = 'primo';
    case SECONDO = 'secondo';
    case CONTORNO = 'contorno';
    case DOLCE = 'dolce';
    case BEVANDA = 'bevanda';
}

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class EProduct
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\Column(type: 'string', enumType: ProductCategory::class)]
    private ProductCategory $category;
    
    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private bool $availability = true;

    // --- MODIFICHE FONDAMENTALI ALLA RELAZIONE ---

    /**
     * @var Collection<int, EAllergens>
     */
    #[ORM\ManyToMany(targetEntity: EAllergens::class, inversedBy: 'products', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'products_allergens')] // Definisce la tabella "ponte" che collega prodotti e allergeni
    private Collection $allergens;

    public function __construct(string $name, string $description, float $price, ProductCategory $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        // Inizializza la collezione come un array vuoto. È un passo obbligatorio.
        $this->allergens = new ArrayCollection();
    }

    // --- GETTERS E SETTERS (invariati) ---
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }
    public function getCategory(): ProductCategory { return $this->category; }
    public function isAvailable(): bool { return $this->availability; }
    public function setAvailability(bool $availability): void { $this->availability = $availability; }

    // --- NUOVI METODI PER GESTIRE LA RELAZIONE CORRETTAMENTE ---

    /**
     * @return Collection<int, EAllergens>
     */
    public function getAllergens(): Collection
    {
        return $this->allergens;
    }

    /**
     * Aggiunge un allergene a questo prodotto, assicurando che la relazione
     * sia consistente su entrambi i lati.
     */
    public function addAllergen(EAllergens $allergen): void
    {
        if (!$this->allergens->contains($allergen)) {
            $this->allergens->add($allergen);
            // Sincronizza l'altro lato della relazione:
            // dice all'allergene che è stato aggiunto a questo prodotto.
            $allergen->addProduct($this);
        }
    }

    /**
     * Rimuove un allergene da questo prodotto.
     */
    public function removeAllergen(EAllergens $allergen): void
    {
        if ($this->allergens->contains($allergen)) {
            $this->allergens->removeElement($allergen);
            // Sincronizza l'altro lato della relazione.
            $allergen->removeProduct($this);
        }
    }
}