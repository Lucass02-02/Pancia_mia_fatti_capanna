{include file='header.tpl'}

<h1>Lista Clienti</h1>

<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nickname</th>
      <th>Punti fedeltà</th>
      <th>Riceve notifiche</th>
    </tr>
  </thead>
  <tbody>
    {foreach $clients as $client}
    <tr>
      <td>{$client.id}</td>
      <td>{$client.nickname|escape}</td>
      <td>{$client.loyaltyPoints}</td>
      <td>{if $client.receivesNotifications}Sì{else}No{/if}</td>
    </tr>
    {/foreach}
  </tbody>
</table>

{include file='footer.tpl'}
