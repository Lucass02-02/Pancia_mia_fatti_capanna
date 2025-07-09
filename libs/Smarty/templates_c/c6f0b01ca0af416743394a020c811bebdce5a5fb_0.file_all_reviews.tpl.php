<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:46:56
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/all_reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dbc00d1ab47_64456529',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6f0b01ca0af416743394a020c811bebdce5a5fb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/all_reviews.tpl',
      1 => 1752022013,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dbc00d1ab47_64456529 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_536813229686dbc00b9c461_75817004', "hero");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1700055733686dbc00ba41c2_04805766', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "base.tpl", $_smarty_current_dir);
}
/* {block "hero"} */
class Block_536813229686dbc00b9c461_75817004 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Tutte le Recensioni' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h1>
        <p>Leggi le opinioni dei nostri clienti!</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
<?php
}
}
/* {/block "hero"} */
/* {block "content"} */
class Block_1700055733686dbc00ba41c2_04805766 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<section id="reviews" class="reviews">
  <div class="container" data-aos="fade-up">

    <?php if ((true && ($_smarty_tpl->hasVariable('reviews') && null !== ($_smarty_tpl->getValue('reviews') ?? null))) && !( !$_smarty_tpl->hasVariable('reviews') || empty($_smarty_tpl->getValue('reviews')))) {?>
      <div class="row gy-4">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
          <div class="col-lg-6">
            <div class="testimonial-item">
              <div class="testimonial-content">
                <?php $_smarty_tpl->assign('author', $_smarty_tpl->getValue('review')->getClient(), false, NULL);?>
                <h3>
                  <?php if ($_smarty_tpl->getValue('author')) {?>
                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('author')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>

                  <?php } else { ?>
                    Utente Anonimo
                  <?php }?>
                </h3>
                <h4><?php echo $_smarty_tpl->getValue('review')->getReviewDate()->format('d/m/Y H:i');?>
</h4>
                <div class="stars">
                  <?php
$__section_star_0_loop = (is_array(@$_loop=$_smarty_tpl->getValue('review')->getRating()) ? count($_loop) : max(0, (int) $_loop));
$__section_star_0_total = $__section_star_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_star'] = new \Smarty\Variable(array());
if ($__section_star_0_total !== 0) {
for ($__section_star_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index'] = 0; $__section_star_0_iteration <= $__section_star_0_total; $__section_star_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index']++){
?><i class="bi bi-star-fill"></i><?php
}
}
?>
                  <?php
$__section_nostar_0_start = (int)@$_smarty_tpl->getValue('review')->getRating() < 0 ? max(0, (int)@$_smarty_tpl->getValue('review')->getRating() + 5) : min((int)@$_smarty_tpl->getValue('review')->getRating(), 5);
$__section_nostar_0_total = min((5 - $__section_nostar_0_start), 5);
$_smarty_tpl->tpl_vars['__smarty_section_nostar'] = new \Smarty\Variable(array());
if ($__section_nostar_0_total !== 0) {
for ($__section_nostar_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nostar']->value['index'] = $__section_nostar_0_start; $__section_nostar_0_iteration <= $__section_nostar_0_total; $__section_nostar_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nostar']->value['index']++){
?><i class="bi bi-star"></i><?php
}
}
?>
                </div>
                <p>
                  "<?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
"
                </p>
              </div>
            </div>
          </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </div>
    <?php } else { ?>
      <p class="text-center">Non ci sono ancora recensioni da mostrare.</p>
    <?php }?>

    <div class="text-center mt-5">
      <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
    </div>

  </div>
</section><!-- End Reviews Section -->
<?php
}
}
/* {/block "content"} */
}
