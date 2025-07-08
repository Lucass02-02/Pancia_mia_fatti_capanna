{include file='header.tpl'}

<h2>Login</h2>

<form method="POST" action="login.php">
  <label>Email:</label><br>
  <input type="email" name="email" required><br><br>

  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit">Accedi</button>
</form>

<p>Non hai un account? <a href="register.php">Registrati qui</a></p>

{if $error}
  <div style="color:red;">{$error}</div>
{/if}

{include file='footer.tpl'}
