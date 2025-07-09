<?php
/* Smarty version 5.5.1, created on 2025-07-09 02:44:53
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/registration.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686dbb85aa2073_31700052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2ab4a02795eeba9df8c958068aa6575608d9e9e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/registration.tpl',
      1 => 1752021889,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686dbb85aa2073_31700052 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1944452741686dbb85a8f212_47187357', "hero");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "base.tpl", $_smarty_current_dir);
}
/* {block "hero"} */
class Block_1944452741686dbb85a8f212_47187357 extends \Smarty\Runtime\Block
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
          <h1 class="text-center mb-4">Registrati</h1>

          <?php if ((true && ($_smarty_tpl->hasVariable('message') && null !== ($_smarty_tpl->getValue('message') ?? null)))) {?>
            <div class="alert <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null))) && $_smarty_tpl->getValue('success')) {?>alert-success<?php } else { ?>alert-danger<?php }?>" role="alert">
              <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('message'), ENT_QUOTES, 'UTF-8', true);?>

            </div>
          <?php }?>

          <form action="/Pancia_mia_fatti_capanna/Client/registration" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="surname" class="form-label">Cognome</label>
              <input type="text" id="surname" name="surname" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="birthDate" class="form-label">Data di Nascita</label>
              <input type="date" id="birthDate" name="birthDate" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Numero di Telefono (Opzionale)</label>
              <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control">
            </div>
            <div class="mb-3">
              <label for="nickname" class="form-label">Nickname (Opzionale)</label>
              <input type="text" id="nickname" name="nickname" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrati</button>
          </form>

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
