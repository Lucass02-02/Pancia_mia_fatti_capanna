<?php
namespace AppORM\Views;

use AppORM\Entity\EProduct;

class VProduct
{
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }

    public function showCreationForm(array $categories, array $allergens)
    {
        $this->smarty->assign('categories', $categories);
        $this->smarty->assign('allAllergens', $allergens);
        $this->smarty->display('create_product.tpl');
    }

    public function showEditForm(EProduct $product, array $categories)
    {
        $this->smarty->assign('product', $product);
        $this->smarty->assign('categories', $categories);
        $this->smarty->display('edit_product.tpl');
    }
}