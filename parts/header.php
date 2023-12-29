<?php
  // Uden wp_head() virkede funktionen (inde i functions.php) ikke til at loade style.css når indholdet er på plads. Ved ikke lige hvad det er wp_head() gør, men den fik vist også ikonerne på wp_footer() til at dukke op..?
  wp_head();
  if(is_user_logged_in()){
    ?>
    <style>
      body{
        padding-top:50px;
      }
    </style>
    <?php
  }
?>
<header class="header">
  logo her <br>

  <?php
    echo get_search_form();

    wp_nav_menu(
      array(
        "menu"            =>  "Primary Menu",
        "container"       =>  "nav",
        "container_class" =>  "main-nav"
      )
    );
  ?>

</header>