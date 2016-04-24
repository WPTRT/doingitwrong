<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wrong
 */
?>

	</div><!-- #content -->
<?php do_action( 'after_content' ); ?>


	<footer id="colophon" class="site-footer" role="contentinfo">

			<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle">Footer Menu</button>
			<?php wp_nav_menu( array( 'theme_location' => 'foter', 'menu_id' => 'access', 'depth' => 1 ) ); ?>
		</nav><!-- #site-navigation -->

		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'wrong' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'wrong' ), 'Wordpress' ); ?></a>
			<?php do_action( 'theme_footer_section' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
