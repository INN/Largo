<?php
/**
 * "Dont Miss" Menu below Main Navigation
 *
 * An optional menu enabled within Appearance --> Theme Options,
 * in the Basic Settings tab under Menu Options. Once enabled the Secondary Nav
 * will appear with the other menus in the WordPress Menu manager.
 *
 * @package Largo
 * @link http://largo.readthedocs.org/users/menus.html#available-menu-areas
 */
?>
<nav id="secondary-nav" class="clearfix">
  <div id="topics-bar" class="span12 hidden-phone">
    <?php 
     /* 
      * A simple navigation menu.
      * Menu is hidden for mobile phones (>769px) 
      */
    largo_nav_menu(
        array(
          'theme_location' => 'dont-miss',
          'container' => false,
          'depth' => 1
        )
      ); 
    ?>
	</div>
</nav>
