<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="news">
    <div class="js-masonry">
      <div class="grid-sizer"></div>
      <div class="gutter-sizer"></div>
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

  echo '<article class="u-pointer" id="follow-us"><a href="https://twitter.com/intent/follow?original_referer=http%3A%2F%2Fa-r-p-a.com&amp;screen_name=__ARPA__" target="_blank">Follow us on Twitter</a></article>';

} else {
  echo '<article class="">Twitter failed to load :{</article>';
}
?>
  <!-- end news -->
    </div>
  </section>


<!-- end main-content -->

</main>

<?php
get_footer();
?>