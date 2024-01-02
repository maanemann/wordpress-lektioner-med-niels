<?php

// MENU :

register_nav_menus(
  array(
    "primary_menu"  => "Primary Menu",
    "footer_menu"   => "Footer Menu"
  )
);

function load_scripts_and_styles() {
  // CSS :
    wp_enqueue_style(
      "style",
      get_template_directory_uri()."/style.css"
    );

  // JS :
    wp_enqueue_script(
      'script-name',
      get_template_directory_uri().'/js/script.js',
      array(),
      '1.0.0',
      true
    );
}

add_action( 'wp_enqueue_scripts', 'load_scripts_and_styles' );

// Der hvor excerpt printes renderes (i archive.php) vises det returnerede (nedenfor) antal ord :
function returner_excerpt_length( $length ) {
  return 10;
}

add_filter("excerpt_length", "returner_excerpt_length", 999);


// THEME SUPPORT :

add_theme_support("post-thumbnails");


// WIDGETS :

  function custom_widgets(){
    register_sidebar(
        array(
            "name"          => "Footer Widgets",
            "id"            => "footer-widget",
            "before_widget" => "<div class='widget'>",
            "after_widget"  => "</div>"
        )
    );
    register_sidebar(
        array(
            "name"          => "Header Widgets",
            "id"            => "header-widget",
            "before_widget" => "<div class='widget'>",
            "after_widget"  => "</div>"
        )
    );
    register_sidebar(
        array(
            "name"          => "My Widget",
            "id"            => "my-widget",
            "before_widget" => "<div class='widget'>",
            "after_widget"  => "</div>"
        )
    );
  }

add_action("widgets_init", "custom_widgets");


// SHORT CODES :
  // Shortcodes skrives i wp editoren i [], fx "[shortcodeName]"

  function shortcodeFunction() {
    return "This shortcode works.";
  }
  add_shortcode("shortcodeName","shortcodeFunction");

  function myWidget() {
    return dynamic_sidebar("my-widget");
  }
  add_shortcode("myWidget","myWidget");

  // Også eksempel på en custom query :
  function printProducts() {
    ob_start();
    $query = new WP_Query(
      [
        "post_status"       => "publish",
        "order"             => "DSC",
        "orderby"           => "name",
        "posts_per_page"    => "100",
        "post_type"         => "Product"
      ]
    );

    while ( $query->have_posts() ) {
      $query->the_post();

      $price = get_post_meta(get_the_id(), "price", true);
      $stock = get_post_meta(get_the_id(), "stock", true);

      ?>
      <a href="#">
        <h2>
          <?php
          the_title();
          ?>
        </h2>
        <?php the_post_thumbnail('thumbnail');
        if ($price == "" || $stock =="") {
          echo "<p> Call us for info </p>";
        }
        ?>
        <p class="meta-price"> Price: <?php echo $price ?> </p>
        <p class="meta-stock"> Stock: <?php echo $stock ?> </p>
      </a>
      <?php
    }

    return ob_get_clean();
  }

  add_shortcode("shop","printProducts");


// CUSTOM POST TYPES :

  // PRODUCTS :

    function product_post_type() {
      register_post_type(
        "product",
        array(
          "show_in_rest"          => true,
          "labels"                => [
            "name"                => "Products",
            "singular_name"       => "Product",
            "add_new"             => "Add new product"
          ],
          "public"                => true,
          "exclude_from_search"   => true,
          "has_archive"           => true,
          // Omskriver URL, så man ikke får alle parametrene med, og det ser pænt ud :
          "rewrite"               => false,
          "supports"              => [
            "title",
            "editor",
            "thumbnail",
            // Vigtig for at kunne lave fx lagerstatus og pris
            "custom-fields"
          ]
        )
      );
    }

    // Init eventen køres når content er loaded? Hvad er forskellen på det og wp_enqueue_scripts?
    add_action("init","product_post_type");

