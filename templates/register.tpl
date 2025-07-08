{include file='header.tpl'}

<h1>Registrazione</h1>

{if $error}
  <div style="color:red;">{$error}</div>
{/if}

{if $success}
  <div style="color:green;">{$success}</div>
{/if}

<form method="POST" action="register.php">
  <label>Nome*:</label><br>
  <input type="text" name="name" required><br><br>

  <label>Cognome*:</label><br>
  <input type="text" name="surname" required><br><br>

  <label>Data di nascita*:</label><br>
  <input type="date" name="birthDate" required><br><br>

  <label>Email*:</label><br>
  <input type="email" name="email" required><br><br>

  <label>Password*:</label><br>
  <input type="password" name="password" required><br><br>

  <label>Telefono:</label><br>
  <input type="text" name="phonenumber"><br><br>

  <button type="submit">Registrati</button>
</form>

{include file='footer.tpl'}