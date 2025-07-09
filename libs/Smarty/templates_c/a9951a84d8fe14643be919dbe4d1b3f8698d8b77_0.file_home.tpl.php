<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:30:11
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686db813af0982_00313101',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9951a84d8fe14643be919dbe4d1b3f8698d8b77' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/home.tpl',
      1 => 1752021008,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686db813af0982_00313101 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_360061582686db813a7e8b1_69986045', "hero");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_532786082686db813aefe77_14768244', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "base.tpl", $_smarty_current_dir);
}
/* {block "hero"} */
class Block_360061582686db813a7e8b1_69986045 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Pancia mia fatti capanna' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h1>
        <p><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio'), ENT_QUOTES, 'UTF-8', true);?>
</p>
        <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn-get-started">Visualizza Menù</a>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
<?php
}
}
/* {/block "hero"} */
/* {block "content"} */
class Block_532786082686db813aefe77_14768244 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<!-- ======= About Section Example ======= -->
<section id="about" class="about">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Benvenuto</h2>
      <p>Scopri il nostro ristorante</p>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <img src="/Pancia_mia_fatti_capanna/assets/img/about.jpg" class="img-fluid" alt="About">
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0 content">
        <h3>Chi siamo</h3>
        <p class="fst-italic">
          Un ristorante accogliente dove il gusto incontra la tradizione.
        </p>
        <ul>
          <li><i class="bi bi-check-circle"></i> Ingredienti freschi ogni giorno</li>
          <li><i class="bi bi-check-circle"></i> Ambiente familiare e confortevole</li>
          <li><i class="bi bi-check-circle"></i> Cucina tradizionale rivisitata</li>
        </ul>
        <p>
          Vieni a provare i nostri piatti e lasciati conquistare dal sapore autentico.
        </p>
      </div>
    </div>

  </div>
</section><!-- End About Section -->
<?php
}
}
/* {/block "content"} */
}
