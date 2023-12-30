<?php
  get_template_part("parts/head");
  // Husk </html> i bunden af filen, <html> er inkluderet i parts/head.
?>
<body>
  <!-- Header --> 
  <?php
    get_template_part("parts/header");
  ?>

  <!-- INDHOLD -->
  <main class="main">
    <h1 class="cat-title">
      <?php
      // ved ikke om ting er rigtige herinde.
        single_cat_title();
      ?>
    </h1>
    <?php
      if( have_posts() ) {
        // Main loop
        while ( have_posts() ) {
          the_post();

          $link = get_the_permalink();
          echo "<a href='$link'>";
            the_title("<h2 class='heading'>", "</h2>");
            ?>
            <figure class="thumb">
              <?php
                the_post_thumbnail("thumbnail");
              ?>
            </figure>
            <div class="content">
              <?php
              the_excerpt();
              ?>
            </div>
          </a>
          <?php
        }
      }
      else {
        echo "404 ingenting fundet";
      }
    ?>
  </main>
  
  <!-- Footer -->
  <?php
  get_template_part("parts/footer");
  ?>
</body>
</html>