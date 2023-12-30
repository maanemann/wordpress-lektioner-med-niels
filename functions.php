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
