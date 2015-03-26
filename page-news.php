<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="news">
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
$content = $connection->get("statuses/user_timeline.json?user_id=507457447&count=70&trim_user=1&include_entities=1&exclude_replies=true&include_rts=false");

if ($content) {
  $i = 0;

  foreach ($content as $tweet) {
    if ($i < 20) {

      echo '<article class="col col4 tweet" id="tweet-' . $tweet->id_str . '">';

    } else {

      echo '<article class="col col4 tweet tweet-hidden" id="tweet-' . $tweet->id_str . '">';

    }

    echo '<div class="meta">';
      $time = strtotime($tweet->created_at);
      echo '<span class="date">' . date('d-m-y' , $time) . '</span>';
      echo '<span class="time">' . date('h:ia' , $time) . '</span>';
    if (!empty($tweet->place)) {echo ' from ' . $tweet->place->full_name;};
      echo '</div>';

    $filtered = preg_replace('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', '', $tweet->text);
      echo link_it($filtered);

    if (!empty($tweet->entities->urls)) {
    foreach ($tweet->entities->urls as $url) {
      echo '<a class="tweet-link" target="_blank" href="' . $url->expanded_url . '">' . $url->display_url . '</a> ';
    }}

    if (!empty($tweet->entities->media)) {
        echo '<div class="news-pad"></div>';
        foreach ($tweet->entities->media as $media) {
          echo '<a target="_blank" href="https://twitter.com/__ARPA__/status/' . $tweet->id_str . '"><img src="' . $media->media_url_https . '" class="tweet" alt="twitter image"></a>';
    }}

    echo '</article>';

    $i++;
  }

  echo '<article class="col col12 pointer" id="show-more-tweets">Show more</article>';

} else {
  echo '<article class="col col4">Twitter failed to load :{</article>';
}
?>
  <!-- end news -->
  </section>


<!-- end main-content -->

</main>

<?php
get_footer();
?>