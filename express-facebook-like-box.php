<?php
/*
Plugin Name: Express Facebook Like Box
Plugin URI: http://wordpress.org/plugins
Author: Mamun
Version: 1.0.0
Description: Custom Made Facebook Likebox Widget Plugin
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


// Action Hooks
add_action( 'widgets_init', 'express_facebook_register_widgets' );

// Express Facebook Widget Functions
function express_facebook_register_widgets() {
	register_widget( 'express_facebook_likebox_widget' );
}

// Express Facebook Widget Class
class express_facebook_likebox_widget extends WP_Widget {

	public function __construct() {
		parent::__construct( 'express_facebook_likebox', 'Express Facebook LikeBox', array( 'description' => 'This is a custom made express facebook likebox widget plugin for WordPress' ) );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'] . $args['before_title'] . $instance['title'] . $args['after_title']; ?>

		<div id="fb-root"></div>
		<script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1328821067129519";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
		</script>

		<div class="fb-page" data-href="<?php echo $instance['url']; ?>"
		     data-small-header="<?php if ( $instance['use-small-header'] == 1 ) {
			     echo "true";
		     } ?>"
		     data-adapt-container-width="true" data-hide-cover="<?php if ( $instance['hide-cover'] == 1 ) {
			echo "true"; } ?>"
		     data-show-facepile="<?php if ( $instance['hide-facepile'] == 1 ) {
			     echo "false";
		     }; ?>"
		     data-tabs="<?php if ( $instance['show-data'] && $instance['show-data-tabs'] ) {
			     if ( $instance['show-data-tabs'] == 1 ) {
				     echo "timeline";
			     } elseif ( $instance['show-data-tabs'] == 2 ) {
				     echo "events";
			     } elseif ( $instance['show-data-tabs'] == 3 ) {
				     echo "message";
			     }
		     } else {
			     echo "false";
		     }; ?>"
		     data-hide-cta="false"
		     data-width=" <?php echo $instance['width']; ?>"
		     data-height="<?php echo $instance['height']; ?>">

			<blockquote cite="<?php echo $instance['url']; ?>" class="fb-xfbml-parse-ignore"><a
					href="<?php echo $instance['url']; ?>"><?php echo $instance['page-title']; ?></a>
			</blockquote>
		</div>


		<?php echo $args['after_widget'];
	}

	public function form( $instance ) {
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
			<input type="text" value="<?php echo $instance['title']; ?>" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('page-title'); ?>">Facebook Page Title: </label>
			<input type="text" value="<?php echo $instance['page-title']; ?>" id="<?php echo $this->get_field_id('page-title'); ?>" name="<?php echo $this->get_field_name('page-title'); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>">Facebook Page URL: </label>
			<input type="text" value="<?php echo esc_url($instance['url']); ?>" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('width'); ?>">Width: </label>
			<input type="number" value="<?php echo $instance['width']; ?>" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" class="widefat">
		</p>
		<p><label for="<?php echo $this->get_field_id('height'); ?>">Height: </label>
			<input type="number" value="<?php echo $instance['height']; ?>" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'hide-cover' ); ?>">Hide Cover: </label>
			<input type="checkbox" value="1" <?php echo checked($instance['hide-cover'], 1); ?> name="<?php echo $this->get_field_name( 'hide-cover' ); ?>"
			       id="<?php echo $this->get_field_id( 'hide-cover' ); ?>" >
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'hide-facepile' ); ?>">Hide Liker Face: </label>
			<input type="checkbox" value="1" <?php echo checked($instance['hide-facepile'], 1); ?> name="<?php echo $this->get_field_name( 'hide-facepile' ); ?>"
			       id="<?php echo $this->get_field_id( 'hide-facepile' ); ?>" >
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'use-small-header' ); ?>">Use Small Header: </label>
			<input type="checkbox" value="1" <?php echo checked($instance['use-small-header'], 1); ?> name="<?php echo $this->get_field_name( 'use-small-header' ); ?>"
			       id="<?php echo $this->get_field_id( 'use-small-header' ); ?>" >
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show-data' ); ?>">Show Posts: </label>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'show-data' ); ?>"
			       value="1" <?php echo checked( $instance['show-data'], 1 ); ?>
			       id="<?php echo $this->get_field_id( 'show-data' ); ?>">
            <select name="<?php echo $this->get_field_name( 'show-data-tabs' ); ?>" class="widefat">
                <option value="1" <?php selected( $instance['show-data-tabs'], 1 ); ?>>Timeline</option>
                <option value="2" <?php selected( $instance['show-data-tabs'], 2 ); ?>>Events</option>
                <option value="3" <?php selected( $instance['show-data-tabs'], 3 ); ?>>Message</option>
            </select>
		</p>


	<?php }

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']            = $new_instance['title'];
		$instance['page-title']       = $new_instance['page-title'];
		$instance['url']              = $new_instance['url'];
		$instance['width']            = $new_instance['width'];
		$instance['height']           = $new_instance['height'];
		$instance['show-data']        = $new_instance['show-data'];
		$instance['hide-cover']       = $new_instance['hide-cover'];
		$instance['hide-facepile']    = $new_instance['hide-facepile'];
		$instance['show-data-tabs']   = $new_instance['show-data-tabs'];
		$instance['use-small-header'] = $new_instance['use-small-header'];
        
		return $instance;

	}


}
