{include file='header.tpl'}

<h1>Aggiungi Ordine</h1>

{if $error}
  <div style="color:red;">{$error}</div>
{/if}

{if $success}
  <div style="color:green;">{$success}</div>
{/if}

<form method="POST" action="aggiungi_ordine.php">
  <h3>Seleziona i piatti e le quantità:</h3>

  {foreach $products as $product}
  <div style="margin-bottom:15px; display:flex; align-items:center;">
    <img src="images/products/{$product.image}" alt="{$product.name}" style="width:80px; height:auto; margin-right:15px; border:1px solid #ccc; padding:3px;">
    <div>
      <input type="checkbox" name="piatti[{$product.id}][selected]" value="1" id="p{$product.id}"> 
      <label for="p{$product.id}"><strong>{$product.name}</strong> - €{$product.price}</label><br>
      <small>{$product.description}</small><br>
      Quantità: <input type="number" name="piatti[{$product.id}][qty]" min="1" value="1" style="width:60px;" disabled>
    </div>
  </div>
{/foreach}


  <button type="submit">Invia Ordine</button>
</form>

{literal}
<script>
  document.querySelectorAll('input[type=checkbox][name^="piatti"]').forEach(chk => {
    chk.addEventListener('change', function() {
      const id = this.id.replace('p', '');
      const qtyInput = document.querySelector(`input[name="piatti[${id}][qty]"]`);
      if (this.checked) {
        qtyInput.disabled = false;
        qtyInput.value = 1;
      } else {
        qtyInput.disabled = true;
        qtyInput.value = '';
      }
    });
  });
</script>
{/literal}

{include file='footer.tpl'}
