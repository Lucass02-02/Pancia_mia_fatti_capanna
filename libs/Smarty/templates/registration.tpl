{* File: templates/registration.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="padding-top: 100px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card p-4 shadow">
          <h1 class="text-center mb-4">Registrati</h1>

          {if isset($message)}
            <div class="alert {if isset($success) && $success}alert-success{else}alert-danger{/if}" role="alert">
              {$message|escape}
            </div>
          {/if}

          <form action="/Pancia_mia_fatti_capanna/Client/registration" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="surname" class="form-label">Cognome</label>
              <input type="text" id="surname" name="surname" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="birthDate" class="form-label">Data di Nascita</label>
              <input type="date" id="birthDate" name="birthDate" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Numero di Telefono (Opzionale)</label>
              <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control">
            </div>
            <div class="mb-3">
              <label for="nickname" class="form-label">Nickname (Opzionale)</label>
              <input type="text" id="nickname" name="nickname" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrati</button>
          </form>

          <div class="text-center mt-3">
            <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}
