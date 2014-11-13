<?php
add_action( 'admin_menu', 'theme_options_menu' );
add_action( 'admin_init', 'settings_init' );
function settings_init(){
	// Theme default settings/options
	$defaults = array( 
		'typography' => array(
			'body_text' => 16,
			'title_text' => 36
			),
		'social' => array(
			'facebook' => '#',
			'twitter' => '#',
			'blogger' => '#',
			'youtube' => '#',
			'pinterest' => '#',
			'gplus' => '#'
			)
		);
	
	// Get the options if they exists
	$options = get_option( 'default_options' );
	
	if( false === $options ){
		add_option( 'default_options', $defaults );
	}
	$settings = wp_parse_args( $defaults, $options );
	update_option( 'default_options', $settings );
	
	register_setting( 'my_theme_options', 'default_options' );	
}

function theme_options_menu(){
	add_theme_page( 'Theme Options', 'Theme options', 'edit_theme_options', 'theme-options', 'options_page_render' );
}

function options_page_render(){ ?>
	<div class="wrap">
	<h2>Theme Options</h2>
	<form action="options.php" method="post">
	<?php settings_fields( 'my_theme_options' ); ?>
	<?php $options = get_option( 'default_options' ); ?>
		<section class="type">
		<h3>Typography</h3>
			<p>Set the font size for body text and title text</p>
			<p>
			<label for="body_text">Body Text</label>
			<input id="default_options[typography][body_text]" name="default_options[typography][body_text]" type="text" value="<?php echo $options['typography']['body_text']; ?>">
			</p>
			<p>
			<label for="title_text">Title Text</label>
			<input id="default_options[typography][title_text]" name="default_options[typography][title_text]" type="text" value="<?php echo $options['typography']['title_text']; ?>">
			</p>	
		</section>
		<section class="social-sharing">
			<h3>Social settings</h3>
			<p>Use your social profile's link</p>
<?php
foreach( $options['social'] as $profile => $url){
	echo '<p>';
	echo '<label for="' . $profile . '">' . $profile . '</label><br/>';
	echo '<input name="default_options[social][' . $profile . ']" type="text" value="' . $url .'" />';
	echo '</p>';
} ?>
		</section>
	<?php submit_button(); ?>
	</form>
	</div>
<?php
}