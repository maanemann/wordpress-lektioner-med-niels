<?php
  get_template_part("parts/head");
  // Husk </html> i bunden af filen, <html> er inkluderet i parts/head.
?>
<body>
  <!-- HEADER : -->
  <?php
    get_template_part("parts/header");
  ?>

  <!-- INDHOLD : -->
  <main class="main">
    <?php
      if( have_posts() ) {
        // Main loop
        while ( have_posts() ) {
          the_post();
          the_title("<h1 class='heading text-red-400'>", "</h1>");
          ?>
          <figure class="thumb">
              <?php
                the_post_thumbnail("medium");
              ?>
          </figure>
          <div class="content">
            <?php
              the_content();
            ?>
          </div>
          <?php
        }
      }

      else {
        echo "404 ingenting fundet";
      }
    ?>
  </main>
  
  <!-- FOOTER : -->
  <?php
  get_template_part("parts/footer");
  ?>
</body>
</html>
