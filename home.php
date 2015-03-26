<?php
get_header();
?>

<!-- main content -->

<section id="splash">
  <div id="splash-arpa">
    ARPA
  </div>
  <div id="splash-noon">
    NOON
  </div>
</section>

<main id="main-content">

  <!-- main posts loop -->
  <section id="home">

    <h2>Information</h2>

<?php
$about = get_page_by_title('information');
if ($about) {
  echo wpautop($about->post_content);
}
?>

    <h2>Clients</h2>

<?php
$clients = get_page_by_title('clients');
if ($clients) {
  echo wpautop($clients->post_content);
}
?>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>