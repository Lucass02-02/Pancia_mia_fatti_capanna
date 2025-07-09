<?php
/* Smarty version 5.5.1, created on 2025-07-09 17:23:33
  from 'file:C:\xampp\htdocs\Pancia_mia_fatti_capanna\AppORM\Services\Utility/../../../libs/Smarty/templates/profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686e8975587ea3_03787837',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b27ac58268c25a54418892fa8c356e952d974ad' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\AppORM\\Services\\Utility/../../../libs/Smarty/templates/profile.tpl',
      1 => 1752071119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686e8975587ea3_03787837 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Pancia_mia_fatti_capanna\\libs\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <style>
        body { font-family: sans-serif; background-color: #f9f9f9; line-height: 1.6; }
        .container { max-width: 900px; margin: 2em auto; padding: 1em; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2, h3 { color: #e8491d; }
        .profile-details, .reviews-section, .cards-section { margin-bottom: 2em; padding: 1.5em; border: 1px solid #ddd; border-radius: 5px; }
        .card-item { display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #eee; }
        .card-item:last-child { border-bottom: none; }
        .delete-form button { background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
        .nav-links { margin-top: 1.5em; text-align: center; }
        .nav-links a { margin: 0 10px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ciao, <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
!</h1>

        <div class="profile-details">
            <h2>I tuoi dati</h2>
            <p><strong>Nome Completo:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('client')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><strong>Data di Nascita:</strong> <?php echo $_smarty_tpl->getValue('client')->getBirthDate()->format('d/m/Y');?>
</p>
            <p><strong>Nickname:</strong> <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getNickname() ?? null)===null||$tmp==='' ? 'Non impostato' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><strong>Telefono:</strong> <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('client')->getPhonenumber() ?? null)===null||$tmp==='' ? 'Non impostato' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</p>
        </div>

        <div class="cards-section">
            <h2>Le tue carte di credito</h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('creditCards')) > 0) {?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('creditCards'), 'card');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('card')->value) {
$foreach0DoElse = false;
?>
                    <div class="card-item">
                        <span>
                            <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getBrand(), ENT_QUOTES, 'UTF-8', true);?>
</strong> che termina con **** <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getLast4(), ENT_QUOTES, 'UTF-8', true);?>

                            (Scade: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getExpMonth(), ENT_QUOTES, 'UTF-8', true);?>
/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('card')->getExpYear(), ENT_QUOTES, 'UTF-8', true);?>
)
                        </span>
                        <form class="delete-form" action="/Pancia_mia_fatti_capanna/client/deleteCreditCard" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa carta?');">
                            <input type="hidden" name="card_id" value="<?php echo $_smarty_tpl->getValue('card')->getId();?>
">
                            <button type="submit">Elimina</button>
                        </form>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <p>Non hai ancora aggiunto nessuna carta di credito.</p>
            <?php }?>
            <a href="/Pancia_mia_fatti_capanna/client/addCreditCard">Aggiungi una nuova carta</a>
        </div>

        <div class="reviews-section">
            <h2>Le tue recensioni</h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reviews')) > 0) {?>
                <ul>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach1DoElse = false;
?>
                        <li>
                            <strong>Voto: <?php echo $_smarty_tpl->getValue('review')->getRating();?>
/5</strong> - 
                            <em>"<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true);?>
"</em>
                            (<?php echo $_smarty_tpl->getValue('review')->getReviewDate()->format('d/m/Y');?>
)
                        </li>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ul>
            <?php } else { ?>
                <p>Non hai ancora lasciato nessuna recensione.</p>
            <?php }?>
            <a href="/Pancia_mia_fatti_capanna/client/addReview">Lascia una nuova recensione</a>
        </div>

        <div class="nav-links">
            <a href="/Pancia_mia_fatti_capanna/">Torna alla Home</a> |
            <a href="/Pancia_mia_fatti_capanna/client/logout">Logout</a>
        </div>
    </div>
</body>
</html><?php }
}
