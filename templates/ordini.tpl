{include file='header.tpl'}

<h1>Lista Ordini</h1>

<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cliente</th>
      <th>Piatti</th>
      <th>Totale (€)</th>
      <th>Data Ordine</th>
    </tr>
  </thead>
  <tbody>
    {foreach $orders as $order}
    <tr>
      <td>{$order.id}</td>
      <td>{$order.cliente|escape}</td>
      <td>{$order.piatti|escape}</td>
      <td>{$order.totale|number_format:2:",":"."}</td>
      <td>{$order.data_ordine}</td>
    </tr>
    {/foreach}
  </tbody>
</table>

{include file='footer.tpl'}


