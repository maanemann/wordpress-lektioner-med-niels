<?php

// Menu

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

// THEME SUPPORT
add_theme_support("post-thumbnails");