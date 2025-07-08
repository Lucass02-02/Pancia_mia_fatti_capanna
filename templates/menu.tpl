{include file='header.tpl'}

<h1>Menù</h1>

<ul>
{foreach $products as $product}
    <li>
        <strong>{$product.name}</strong> - €{$product.price|number_format:2:",":"."}<br>
        <small>{$product.description}</small>
    </li>
{/foreach}
</ul>

{include file='footer.tpl'}



