<?php
/**
 * The hero area for the theme
 */

$img = get_theme_mod( 'hero-image' );
$phrase = get_theme_mod( 'hero-phrase' );
$button = get_theme_mod( 'hero-button' );

$hero = $img || $phrase || $button;

if ( ! $hero ): ?>
<div class="section hero" style="background: url('<?php echo get_stylesheet_directory_uri(); ?>/img/hero-bg.jpg');height:500px;">
<span class="hero-phrase">Our theme is the number 5 rated in this cool marketplace. <a href="#">Read more about it</a></span>
</div>
<?php
endif;
