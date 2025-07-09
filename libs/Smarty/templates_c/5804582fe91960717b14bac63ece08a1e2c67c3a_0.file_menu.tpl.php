<?php
/* Smarty version 5.5.1, created on 2025-07-09 03:32:07
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dc697c173d7_58755115',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5804582fe91960717b14bac63ece08a1e2c67c3a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/menu.tpl',
      1 => 1752024725,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dc697c173d7_58755115 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1372527961686dc697bf7a53_12007574', "hero");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_673962308686dc697bfb525_48249814', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "base.tpl", $_smarty_current_dir);
}
/* {block "hero"} */
class Block_1372527961686dc697bf7a53_12007574 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Il Nostro Menù</h1>
        <p>Scopri i nostri piatti e ordina comodamente!</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
<?php
}
}
/* {/block "hero"} */
/* {block "content"} */
class Block_673962308686dc697bfb525_48249814 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
  <div class="container" data-aos="fade-up">

    <?php if ($_smarty_tpl->getValue('isAdmin')) {?>
      <div class="text-center mb-4">
        <a href="/Pancia_mia_fatti_capanna/Product/create" class="btn btn-success me-2">Aggiungi Prodotto</a>
        <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn btn-info">Gestisci Allergeni</a>
      </div>
    <?php }?>

    <div class="section-title">
      <h2>Filtra per allergeni</h2>
      <p>Mostra piatti senza:</p>
    </div>

    <form action="/Pancia_mia_fatti_capanna/Home/menu" method="GET" class="mb-5">
      <div class="row gy-2 gx-3 justify-content-center">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allAllergens'), 'allergen');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allergen')->value) {
$foreach0DoElse = false;
?>
          <div class="col-auto">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="allergens[]" value="<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
"
                     <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('allergen')->getId(),$_smarty_tpl->getValue('selectedAllergens'))) {?>checked<?php }?>
                     id="allergen<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
">
              <label class="form-check-label" for="allergen<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
">
                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allergen')->getAllergenType(), ENT_QUOTES, 'UTF-8', true);?>

              </label>
            </div>
          </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <div class="col-12 text-center mt-3">
          <button type="submit" class="btn btn-primary">Applica Filtro</button>
          <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
        </div>
      </div>
    </form>

    <?php if (( !$_smarty_tpl->hasVariable('products') || empty($_smarty_tpl->getValue('products')))) {?>
      <p class="text-center text-muted">Nessun piatto disponibile con i filtri selezionati.</p>
    <?php } else { ?>
      <div class="row gy-4">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach1DoElse = false;
?>
          <div class="col-lg-4 menu-item">
            <div class="menu-content">
              <a href="#"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</a><span>€ <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getPrice(),2,",",".");?>
</span>
            </div>
            <div class="menu-ingredients">
              <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>

            </div>

            <?php if ($_smarty_tpl->getValue('isLoggedIn') && !$_smarty_tpl->getValue('isAdmin')) {?>
              <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST" class="mt-2">
                <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
                <div class="input-group">
                  <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" aria-label="Quantità">
                  <button type="submit" class="btn btn-primary">Aggiungi</button>
                </div>
              </form>
            <?php } elseif (!$_smarty_tpl->getValue('isLoggedIn')) {?>
              <p class="text-muted mt-2">Accedi per aggiungere al carrello.</p>
            <?php }?>

            <?php if ($_smarty_tpl->getValue('isAdmin')) {?>
              <div class="d-flex flex-wrap gap-2 mt-3">
                <a href="/Pancia_mia_fatti_capanna/Product/edit/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-warning btn-sm">Modifica</a>
                <?php if ($_smarty_tpl->getValue('product')->isAvailable()) {?>
                  <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-secondary btn-sm">Rendi Non Disp.</a>
                <?php } else { ?>
                  <a href="/Pancia_mia_fatti_capanna/Product/toggleAvailability/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-success btn-sm">Rendi Disp.</a>
                <?php }?>
                <a href="/Pancia_mia_fatti_capanna/Product/delete/<?php echo $_smarty_tpl->getValue('product')->getId();?>
" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto? L\'azione è irreversibile.');">Elimina</a>
              </div>
            <?php }?>
          </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </div>
    <?php }?>

    <div class="text-center mt-5">
      <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
      <?php if ($_smarty_tpl->getValue('isLoggedIn') && !$_smarty_tpl->getValue('isAdmin')) {?>
        <a href="/Pancia_mia_fatti_capanna/Cart/view" class="btn btn-primary ms-2">Vai al Carrello</a>
      <?php }?>
    </div>

  </div>
</section><!-- End Menu Section -->
<?php
}
}
/* {/block "content"} */
}
