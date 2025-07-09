{* File: templates/all_reviews.tpl *}
{extends file="base.tpl"}

{block name="hero"}
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h1>{$titolo|default:'Tutte le Recensioni'|escape}</h1>
        <p>Leggi le opinioni dei nostri clienti!</p>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
{/block}

{block name="content"}
<section id="reviews" class="reviews">
  <div class="container" data-aos="fade-up">

    {if isset($reviews) && !empty($reviews)}
      <div class="row gy-4">
        {foreach $reviews as $review}
          <div class="col-lg-6">
            <div class="testimonial-item">
              <div class="testimonial-content">
                {assign var="author" value=$review->getClient()}
                <h3>
                  {if $author}
                    {$author->getName()|escape} {$author->getSurname()|escape}
                  {else}
                    Utente Anonimo
                  {/if}
                </h3>
                <h4>{$review->getReviewDate()->format('d/m/Y H:i')}</h4>
                <div class="stars">
                  {section name=star loop=$review->getRating()}<i class="bi bi-star-fill"></i>{/section}
                  {section name=nostar start=$review->getRating() loop=5}<i class="bi bi-star"></i>{/section}
                </div>
                <p>
                  "{$review->getComment()|escape|nl2br}"
                </p>
              </div>
            </div>
          </div>
        {/foreach}
      </div>
    {else}
      <p class="text-center">Non ci sono ancora recensioni da mostrare.</p>
    {/if}

    <div class="text-center mt-5">
      <a href="/Pancia_mia_fatti_capanna/Home/home" class="btn btn-secondary">Torna alla Home</a>
    </div>

  </div>
</section><!-- End Reviews Section -->
{/block}
