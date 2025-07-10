<?php
/* Smarty version 5.5.1, created on 2025-07-10 02:07:47
  from 'file:/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/all_reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686f045300b6a6_58559145',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ee59fde1d946acbd736cd3be553da0fa0ec7c61' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/AppORM/Services/Utility/../../../libs/Smarty/templates/all_reviews.tpl',
      1 => 1752106025,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686f045300b6a6_58559145 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Pancia_mia_fatti_capanna/libs/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
 - Pancia mia fatti capanna</title>
    <link rel="stylesheet" href="/Pancia_mia_fatti_capanna/libs/Smarty/css/styles.css">
    <style>
        /* Stili aggiuntivi per le risposte */
        .admin-response {
            background-color: #e9ecef; /* Grigio chiaro */
            border-left: 4px solid #007bff; /* Bordo blu */
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            position: relative; /* Per posizionare il pulsante di eliminazione */
        }
        .admin-response small {
            font-size: 0.85em;
            color: #6c757d;
        }
        .admin-response-form {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ced4da;
        }
        .admin-response .delete-response-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: .1rem .4rem; /* Pulsante più piccolo */
            font-size: .7rem;
        }
        .admin-response .edit-response-btn { /* Stile per il pulsante di modifica risposta admin */
            position: absolute;
            top: 5px;
            right: 45px; /* Spostato a sinistra del pulsante Elimina */
            padding: .1rem .4rem;
            font-size: .7rem;
            background-color: #ffc107; /* Giallo warning */
            border-color: #ffc107;
            color: #212529;
        }
        .admin-response .edit-response-btn:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="text-primary text-center mb-5"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('titolo'), ENT_QUOTES, 'UTF-8', true);?>
</h1>

    <?php if (( !$_smarty_tpl->hasVariable('reviews') || empty($_smarty_tpl->getValue('reviews')))) {?>
        <p class="text-center text-muted">Non ci sono ancora recensioni da mostrare.</p>
    <?php } else { ?>
        <div class="row g-4">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text fst-italic">"<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getComment(), ENT_QUOTES, 'UTF-8', true);?>
"</p>
                            <p class="card-text"><strong>Voto: <?php echo $_smarty_tpl->getValue('review')->getRating();?>
/5</strong></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-light flex-wrap">
                           <small class="text-muted">
                                Di: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getClient()->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getClient()->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
<br>
                                Scritta il: <?php echo $_smarty_tpl->getValue('review')->getCreationDate()->format('d/m/Y');?>

                           </small>
                           
                                                                              </div>
                        
                                                <?php if (!$_smarty_tpl->getValue('review')->getAdminResponses()->isEmpty()) {?>
                            <div class="card-body pt-0">
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('review')->getAdminResponses(), 'response');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('response')->value) {
$foreach1DoElse = false;
?>
                                    <div class="admin-response">
                                        <p class="mb-1"><strong>Risposta dell'Admin:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('response')->getResponseText(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                        <small class="d-block text-end">
                                            Di: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('response')->getAdmin()->getName(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('response')->getAdmin()->getSurname(), ENT_QUOTES, 'UTF-8', true);?>
<br>
                                            Inviata il: <?php echo $_smarty_tpl->getValue('response')->getResponseDate()->format('d/m/Y H:i');?>

                                        </small>
                                        
                                                                                <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                                                                                        <a href="/Pancia_mia_fatti_capanna/review/editAdminResponse/<?php echo $_smarty_tpl->getValue('response')->getId();?>
" class="btn btn-warning btn-sm edit-response-btn">Modifica</a>

                                                                                        <form action="/Pancia_mia_fatti_capanna/review/deleteAdminResponse/<?php echo $_smarty_tpl->getValue('response')->getId();?>
" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa risposta dell\'admin?');" class="delete-response-btn">
                                                <button type="submit" class="btn btn-danger btn-sm">X</button>
                                            </form>
                                        <?php }?>
                                    </div>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </div>
                        <?php }?>

                                                <?php if ($_smarty_tpl->getValue('user_role') == 'admin') {?>
                            <div class="card-body admin-response-form">
                                <h5>Rispondi a questa recensione:</h5>
                                <form action="/Pancia_mia_fatti_capanna/review/respond" method="POST">
                                    <input type="hidden" name="review_id" value="<?php echo $_smarty_tpl->getValue('review')->getId();?>
">
                                    <div class="mb-3">
                                        <textarea name="response_text" class="form-control" rows="3" placeholder="Scrivi qui la tua risposta..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Invia Risposta</button>
                                </form>
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
        <a href="/Pancia_mia_fatti_capanna/" class="btn btn-secondary">Torna alla Home</a>
    </div>
</div>

</body>
</html><?php }
}
