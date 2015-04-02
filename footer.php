
  </section>

  <?php get_template_part('partials/scripts'); ?>

<?php
$home_id = get_option('page_on_front');
$info_meta = get_post_meta($home_id, false);
$address = $info_meta['_igv_address'][0];
$address_replaced = preg_replace("/[\s]/","+",$address);
$email = $info_meta['_igv_email'][0];
?>

    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "<?php echo home_url(); ?>",
      "logo": "<?php echo bloginfo('stylesheet_directory'); ?>/img/arpa.png",
      "sameAs" : [
        "https://twitter.com/__ARPA__",
        "https://www.facebook.com/aresearchprojectsagency"
        ]
    }
  </script>

  </body>
</html>