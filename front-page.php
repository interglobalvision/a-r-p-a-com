<?php
get_header();
?>

<!-- main content -->

<section id="splash">
  <div id="splash-arpa">
    <div class="splash-text">ARPA</div>
  </div>
  <a href="#">
    <div id="splash-noon">
      <div class="splash-text">NOON</div>
    </div>
  </a>
</section>

<main id="main-content">

  <!-- main posts loop -->
  <section id="home">
    <div class="container">

      <h2><span>Information</span></h2>

<?php the_content(); ?>

<?php
//CLIENTS

$args = array (
  'post_type'              => 'clients',
  'order'                  => 'ASC',
  'orderby'                => 'title',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
  echo '<h2><span>Clients</span></h2>';
  echo '<ul>';
  while ( $query->have_posts() ) {
    $query->the_post();
    echo '<li data-client="'.get_the_id().'">'.get_the_title().'</li>';
  }
  echo '</ul>';
} else {
  // no posts found
}

// Restore original Post Data
wp_reset_postdata();
?>

  <!-- end posts -->
    </div>
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>