<?php
/**
 * The hero area for the theme
 */

$img = get_theme_mod( 'hero-image' );
$phrase = get_theme_mod( 'hero-phrase' );
$button = get_theme_mod( 'hero-button' );

$hero = $img || $phrase || $button;

if ( ! $hero ): ?>
<div class="section hero" style="background: url('<?php echo get_template_directory_uri(); ?>/img/hero-bg.jpg');height:500px;">
<span>Our theme is the number 5 rated in this cool marketplace</span>
<a href="#">Read more about it</a>
</div>
<?php
endif;
