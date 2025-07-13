{* File: templates/cart.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>Il Mio Carrello</h1>
        <p>Controlla i tuoi ordini prima di procedere al checkout.</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<section id="cart" class="cart">
  <div class="container" data-aos="fade-up" style="max-width: 800px;">

    {if empty($cartItems)}
      <p class="text-center text-muted">Il tuo carrello è vuoto. <a href="/Pancia_mia_fatti_capanna/Home/menu" class="link-primary">Vai al menù</a> per aggiungere prodotti!</p>
    {else}
      {assign var="total" value=0}
      {foreach $cartItems as $item}
        {assign var="itemTotal" value=$item['price'] * $item['quantity']}
        {assign var="total" value=$total + $itemTotal}
        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
          <div>
            <strong>{$item['name']|escape}</strong><br>
            <small>Quantità: {$item['quantity']} x € {$item['price']|number_format:2:',':'.'} = € {$itemTotal|number_format:2:',':'.'}</small>
          </div>
          <div class="btn-group" role="group">
            <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
              <input type="hidden" name="product_id" value="{$item['product_id']}">
              <input type="hidden" name="remove_one" value="1">
              <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
            </form>
            <form action="/Pancia_mia_fatti_capanna/Cart/add" method="POST">
              <input type="hidden" name="product_id" value="{$item['product_id']}">
              <input type="hidden" name="quantity" value="1">
              <input type="hidden" name="from_cart" value="true">
              <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
            </form>
            <form action="/Pancia_mia_fatti_capanna/Cart/remove" method="POST">
              <input type="hidden" name="product_id" value="{$item['product_id']}">
              <button type="submit" class="btn btn-danger btn-sm">Rimuovi</button>
            </form>
          </div>
        </div>
      {/foreach}

      <div class="text-end mt-4 fs-5 fw-bold">
        Totale Carrello: € {$total|number_format:2:',':'.'}
      </div>

      <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
        <a href="/Pancia_mia_fatti_capanna/Home/menu" class="btn btn-primary">Torna al Menù</a>
        <form action="/Pancia_mia_fatti_capanna/Cart/clear" method="POST">
          <button type="submit" class="btn btn-secondary">Svuota Carrello</button>
        </form>
        <a href="/Pancia_mia_fatti_capanna/Cart/checkout" class="btn btn-success">Procedi al Checkout</a>
      </div>
    {/if}

  </div>
</section><!-- End Cart Section -->
{/block}
