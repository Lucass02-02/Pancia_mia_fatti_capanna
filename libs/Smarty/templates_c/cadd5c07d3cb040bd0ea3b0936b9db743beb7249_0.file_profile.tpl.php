<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:45:21
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dbba15e0e00_14797323',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cadd5c07d3cb040bd0ea3b0936b9db743beb7249' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/profile.tpl',
      1 => 1752021845,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dbba15e0e00_14797323 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_920496666686dbba15c0de1_90151126', "hero");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_279167357686dbba15c4f74_41670886', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "base.tpl", $_smarty_current_dir);
}
/* {block "hero"} */
class Block_920496666686dbba15c0de1_90151126 extends \Smarty\Runtime\Block
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
class Block_279167357686dbba15c4f74_41670886 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
  <div class="container" data-aos="fade-up">

    <?php if ($_smarty_tpl->getValue('isAdmin')) {?>
      <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="/Pancia_mia_fatti_capanna/Product/create" class="btn btn-success">Aggiungi Nuovo Prodotto</a>
        <a href="/Pancia_mia_fatti_capanna/Allergen/manage" class="btn btn-info">Gestisci Allergeni</a>
      </div>
    <?php }?>

    <div class="section-title">
      <h2>Filtra</h2>
      <p>Filtra per allergeni (mostra piatti senza)</p>
    </div>

    <form action="/Pancia_mia_fatti_capanna/Home/menu" method="GET">
      <div class="row gy-3">
        <?php if ((true && ($_smarty_tpl->hasVariable('allAllergens') && null !== ($_smarty_tpl->getValue('allAllergens') ?? null))) && !( !$_smarty_tpl->hasVariable('allAllergens') || empty($_smarty_tpl->getValue('allAllergens')))) {?>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allAllergens'), 'allergen');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allergen')->value) {
$foreach0DoElse = false;
?>
            <div class="col-md-3 col-sm-4 col-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="allergens[]" value="<?php echo $_smarty_tpl->getValue('allergen')->getId();?>
"
                  <?php if ((true && ($_smarty_tpl->hasVariable('selectedAllergens') && null !== ($_smarty_tpl->getValue('selectedAllergens') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('allergen')->getId(),$_smarty_tpl->getValue('selectedAllergens'))) {?>checked<?php }?>
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
        <?php }?>
      </div>
      <div class="mt-3 text-center">
        <button type="submit" class="btn btn-primary">Applica Filtro</button>
        <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-secondary ms-2">Rimuovi Filtro</a>
      </div>
    </form>

    <?php if (( !$_smarty_tpl->hasVariable('products') || empty($_smarty_tpl->getValue('products')))) {?>
      <p class="text-center text-muted mt-5">Nessun piatto trovato con i filtri selezionati.</p>
    <?php } else { ?>
      <div class="row gy-4 mt-4">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach1DoElse = false;
?>
          <div class="col-lg-4 menu-item">
            <div class="menu-content <?php if ($_smarty_tpl->getValue('isAdmin') && !$_smarty_tpl->getValue('product')->isAvailable()) {?>opacity-50<?php }?>">
              <h4><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h4>
              <p class="ingredients"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescription(), ENT_QUOTES, 'UTF-8', true);?>
</p>
              <p class="price">€ <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getPrice(),2,',','.');?>
</p>

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
                <p class="text-end text-muted mt-2">Accedi per aggiungere al carrello.</p>
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
