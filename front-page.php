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
      <div class="col col6">
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
?>
        <h2><span>Clients</span></h2>
          <ul>
<?php 
  while ( $query->have_posts() ) {
    $query->the_post();
    echo '<li><a href="#'.$post->post_name.'">'.get_the_title().'</a></li>';
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
      <div class="u-cf"></div>
    </div>
  </section>


  <!-- result -->
  <section id="result">

  <!-- end result -->
  </section>
  
  <!-- news -->
  <section id="news">
    <div class="container js-masonry">
      <div class="grid-sizer"></div>
      <div class="gutter-sizer"></div>
<?php
function link_it($text) {
  $text= preg_replace("/ @(\w+)/", ' <a href="http://www.twitter.com/$1" target="_blank">@$1</a>', $text);
  $text= preg_replace("/\#(\w+)/", '<a href="http://search.twitter.com/search?q=$1" target="_blank">#$1</a>',$text);
  return($text);
}

require_once('lib/oauth/twitterauth.php');
function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth('ElYwUKMwhrghoTHilLXPuQ', 'lfkur0NztBaSOI8uNbawatyYLcz3mdCyK0u5PxJD8', $oauth_token, $oauth_token_secret);
  return $connection;
}

$connection = getConnectionWithAccessToken("188722649-uikbR3s3hmh9gzx2IGul9m41gZFAcwpPw1JavWY9", "UhanOS1qRVW9Xx894ZkfvHhAYS0E6HCJ0SkeH9Kpw");
$content = $connection->get("statuses/user_timeline.json?user_id=507457447&count=100&trim_user=1&include_entities=1&exclude_replies=true&include_rts=false");

if ($content) {
  $i = 0;

  foreach ($content as $tweet) {
    if ($i < 30) {

      echo '<article class="col col3 tweet item" id="tweet-' . $tweet->id_str . '">';

      echo '<div class="tweet-meta"><a target="_blank" href="https://twitter.com/__ARPA__/status/' . $tweet->id_str . '">';
        $time = strtotime($tweet->created_at);
        echo '<span class="date">' . date('j l Y' , $time) . '</span>';
        echo '<span class="time"> - ' . date('g:i' , $time) . '</span>';
      //if (!empty($tweet->place)) {echo '<span class="location"> - from ' . $tweet->place->full_name . '</span>';};
        echo '</a></div>';

      $filtered = preg_replace('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', '', $tweet->text);
        echo link_it($filtered);

      if (!empty($tweet->entities->urls)) {
      foreach ($tweet->entities->urls as $url) {
        echo '<a class="tweet-link" target="_blank" href="' . $url->expanded_url . '">' . $url->display_url . '</a> ';
      }}

      if (!empty($tweet->entities->media)) {
          foreach ($tweet->entities->media as $media) {
            echo '<a target="_blank" href="https://twitter.com/__ARPA__/status/' . $tweet->id_str . '"><img src="' . $media->media_url_https . '" class="tweet-img" alt="twitter image"></a>';
      }}

      echo '</article>';

      $i++;

    } else {

      // over 30 tweets

    }
  }

  echo '<article class="col col6 u-pointer" id="follow-us"><a href="https://twitter.com/intent/follow?original_referer=http%3A%2F%2Fa-r-p-a.com&amp;screen_name=__ARPA__" target="_blank">Follow us on Twitter</a></article>';

} else {
  echo '<article class="col col2">Twitter failed to load :{</article>';
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