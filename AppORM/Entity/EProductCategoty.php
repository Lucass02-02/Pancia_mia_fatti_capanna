<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppORM\Services\Foundation\FProductCategory;



#[ORM\Entity]
#[ORM\Table(name: 'product_category')]
class EProductCategory 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    private string $name;

    #[ORM\OneToMany(targetEntity: EProduct::class, mappedBy: 'category')]
    private Collection $products;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->products = new ArrayCollection();
    }

    // --- Metodi Getter ---
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getProducts(): Collection { return $this->products; }
     /**
     * Salva o aggiorna una categoria di prodotti.
     */
    public static function saveProductCategory(EProductCategory $category): bool 
    { 
        return FProductCategory::saveObj($category); 
    }
    /**
     * Imposta un nuovo nome per la categoria di prodotto.
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Recupera una categoria tramite ID.
     */
    public static function getProductCategoryById(int $id): ?EProductCategory 
    { 
        return FProductCategory::getObj($id); 
    }

    /**
     * Recupera tutte le categorie di prodotti.
     */
    public static function getAllProductCategories(): array
    {
        return FProductCategory::selectAll();
    }
    
    /**
     * Cancella una categoria di prodotti.
     */
    public static function deleteProductCategory(EProductCategory $category): bool 
    { 
        return FProductCategory::deleteObj($category); 
    }

    /**
     * Aggiorna il nome di una categoria esistente.
     */
    public static function updateProductCategoryName(EProductCategory $category, string $newName): bool
    {
        $category->setName($newName);
        return FProductCategory::saveObj($category);
    }
}