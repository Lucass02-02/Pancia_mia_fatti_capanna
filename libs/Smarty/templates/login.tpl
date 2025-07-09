{* File: templates/login.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card p-4 shadow">
          <h1 class="text-center mb-4">Login</h1>

          {if isset($error)}
            <div class="alert alert-danger text-center">{$error|escape}</div>
          {/if}

          <form action="/Pancia_mia_fatti_capanna/Client/login" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Accedi</button>
          </form>

          <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Client/registration">Non hai un account? Registrati</a>
          </div>

          <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}
