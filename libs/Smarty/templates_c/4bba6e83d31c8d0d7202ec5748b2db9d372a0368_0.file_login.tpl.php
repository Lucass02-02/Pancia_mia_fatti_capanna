<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:41:06
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dbaa2e75d19_46718965',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4bba6e83d31c8d0d7202ec5748b2db9d372a0368' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/login.tpl',
      1 => 1752021664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dbaa2e75d19_46718965 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1773317355686dbaa2e6b8b9_46629514', "hero");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "base.tpl", $_smarty_current_dir);
}
/* {block "hero"} */
class Block_1773317355686dbaa2e6b8b9_46629514 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card p-4 shadow">
          <h1 class="text-center mb-4">Login</h1>

          <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('error'), ENT_QUOTES, 'UTF-8', true);?>
</div>
          <?php }?>

          <form action="/Pancia_mia_fatti_capanna/Client/login" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Accedi</button>
          </form>

          <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Client/registration">Non hai un account? Registrati</a>
          </div>

          <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
<?php
}
}
/* {/block "hero"} */
}
