<?php
get_header();
?>

<!-- main content -->

<section id="splash">
  <div id="splash-arpa" class="u-holder u-align-center">
    <div class="u-held">
      <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/optimized/arpa.svg'); ?>
    </div>
  </div>
  <a href="http://n-o-o-n.co.uk">
    <div id="splash-noon" class="u-holder u-align-center"
<?php
  $noonImage = json_decode(file_get_contents('http://n-o-o-n.co.uk/data/'));
  if ($noonImage->noon) {
    echo 'style="background-image: url(' . $noonImage->noon . ')"';
  }
?>>
      <div class="u-held">
        <?php echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/optimized/noon.svg'); ?>
      </div>
    </div>
  </a>
</section>

<!-- main home content -->
<section id="home">
  <div id="home-container" class="container u-cf">
    <div class="u-holder js-window">
      <div class="u-held">
        <div class="col col10">
          <h2><span>Information</span></h2>
          <?php the_content(); ?>
<?php
$args = array (
  'post_type' => 'clients',
  'order' => 'ASC',
  'orderby' => 'title',
  'posts_per_page' => -1
);
$clients = get_posts( $args );
if ( $clients ) {
?>
      <h2><span>Clients</span></h2>
        <ul id="clients">
<?php
foreach ($clients as $post) {
  $name = get_the_title();
  echo '<li><a href="#!/'.$post->post_name.'">'.$name.'</a></li>';
}
?>
        </ul>
<?php
} else {
// no posts found
}

// Restore original Post Data
wp_reset_postdata();
?>

    <!-- end posts -->
        </div>
      </div>
    </div>
  </div>
</section>

<main id="main-content">

  <!-- ajax content -->
  <section id="result">

  <!-- end result -->
  </section>

  <!-- news -->
  <section id="news">
    <div class="js-masonry">

<?php
require_once('lib/oauth/twitterauth.php');
$connection = getConnectionWithAccessToken("188722649-uikbR3s3hmh9gzx2IGul9m41gZFAcwpPw1JavWY9", "UhanOS1qRVW9Xx894ZkfvHhAYS0E6HCJ0SkeH9Kpw");
$content = $connection->get("statuses/user_timeline.json?user_id=507457447&count=100&trim_user=1&include_entities=1&exclude_replies=true&include_rts=false");

if ($content) {
  $i = 0;

  foreach ($content as $tweet) {
    if ($i < 30) {

      echo '<article class="tweet item" id="tweet-' . $tweet->id_str . '">';

      echo '<div class="tweet-meta"><a target="_blank" href="https://twitter.com/__ARPA__/status/' . $tweet->id_str . '">';
      $time = strtotime($tweet->created_at);
      echo '<span class="date">' . date('j l Y' , $time) . '</span>';
      echo '<span class="time"> - ' . date('g:i' , $time) . '</span>';
      echo '</a></div>';

      $filtered = preg_replace('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', '', $tweet->text);
      echo link_it($filtered);

      if (!empty($tweet->entities->urls)) {
        foreach ($tweet->entities->urls as $url) {
          echo '<a class="tweet-link" target="_blank" href="' . $url->expanded_url . '">' . $url->display_url . '</a> ';
        }
      }

      if (!empty($tweet->entities->media)) {
        foreach ($tweet->entities->media as $media) {
          echo '<a target="_blank" href="https://twitter.com/__ARPA__/status/' . $tweet->id_str . '" ><img src="' . $media->media_url_https . '" class="tweet-img" alt="twitter image"></a>';
        }
      }

      echo '</article>';

      $i++;

    } else {

      // over 30 tweets

    }
  }

  echo '<article id="follow-us"><a href="https://twitter.com/intent/follow?original_referer=http%3A%2F%2Fa-r-p-a.com&amp;screen_name=__ARPA__" target="_blank">Follow us on Twitter</a></article>';

} else {
  echo '<article>Twitter failed to load :{</article>';
}
?>
  <!-- end news -->
      <div class="u-cf"></div>
    </div>
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>