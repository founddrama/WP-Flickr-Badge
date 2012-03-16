<?php
/**
 * Plugin Name: WP Flickr Badge
 * Version: 0.1
 * Plugin URI: https://github.com/founddrama/WP-Flickr-Badge
 * Description: Super-simple Flickr badge plugin for WordPress blog sidebars.
 * Author: Rob Friesel
 * Author URI: http://blog.founddrama.net
*/
class WP_Flickr_Badge extends WP_Widget {
	/** constructor */
	function WP_Flickr_Badge() {
		$widget_ops = array('classname' => 'widget_wp_flickr_badge', 'description' => __('The a simple Flickr badge'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('wp_flickr_badge', __('WP Flickr Badge'), $widget_ops, $control_ops);
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract($args);
		/* 28555778%40N00 */
		$flickr_user = $instance['flickr_user'];
		$count = $instance['photo_count'];
		$display = $instance['photo_display'];
		$size = $instance['photo_size'];
		echo $before_widget;
		if ( $flickr_user ) ?>
				<div id="flickr_badge_uber_wrapper"><div id="flickr_badge_wrapper"></div><a href="http://www.flickr.com" id=flickr_www><span id="flickr_www_wrapper">flick<span style="color:#ff1c92;">r</span></span></a></div>
			<?php
			add_action('wp_footer',
				create_function('', 'echo \'<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $count . '&display=' . $display . '&size=' . $size . '&layout=x&source=user&user=' . $flickr_user . '"></script>\';')
			);
			echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['flickr_user'] = $new_instance['flickr_user'];
		$instance['photo_count'] = $new_instance['photo_count'];
		$instance['photo_display'] = $new_instance['photo_display'];
		$instance['photo_size'] = $new_instance['photo_size'];
		return $instance;
	}
	
	function form($instance) {
		$flickr_user = esc_attr($instance['flickr_user']);
		$photo_count = esc_attr($instance['photo_count']);
		$photo_display = esc_attr($instance['photo_display']);
		$photo_size = esc_attr($instance['photo_size']);
		?>
			<p>
				<label for="<?php echo $this->get_field_id('flickr_user'); ?>"><?php _e('Flickr User ID:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_user'); ?>" name="<?php echo $this->get_field_name('flickr_user'); ?>" type="text" value="<?php echo $flickr_user; ?>" /></label>
				<label for="<?php echo $this->get_field_id('photo_count'); ?>"><?php _e('Number of Photos:'); ?> <select class="widefat" id="<?php echo $this->get_field_id('photo_count'); ?>" name="<?php echo $this->get_field_name('photo_count'); ?>"><?php
					for ( $i = 1; $i <= 10; ++$i ) {
						echo "<option value=\"$i\" " . ( $photo_count == $i ? 'selected="selected"' : '' ) . ">$i</option>";
					}
				?></select></label>
				<label for="<?php echo $this->get_field_id('photo_display'); ?>"><?php _e('Which Photos:'); ?> <select class="widefat" id="<?php echo $this->get_field_id('photo_display'); ?>" name="<?php echo $this->get_field_name('photo_display'); ?>">
					<option value="latest" <?php echo ( $photo_display == 'latest' ? 'selected="selected"' : '' ) ; ?>>Most Recent</option>
					<option value="random" <?php echo ( $photo_display == 'random' ? 'selected="selected"' : '' ) ; ?>>Random Selection</option>
				</select></label>
				<label for="<?php echo $this->get_field_id('photo_size'); ?>"><?php _e('Photo Size:'); ?> <select class="widefat" id="<?php echo $this->get_field_id('photo_size'); ?>" name="<?php echo $this->get_field_name('photo_size'); ?>">
					<option value="s" <?php echo ( $photo_size == 's' ? 'selected="selected"' : '' ) ; ?>>Small Square</option>
					<option value="t" <?php echo ( $photo_size == 't' ? 'selected="selected"' : '' ) ; ?>>Thumbnail</option>
					<option value="m" <?php echo ( $photo_size == 'm' ? 'selected="selected"' : '' ) ; ?>>Mid-size</option>
				</select></label>
			</p>
		<?php
	}
	
}

add_action('widgets_init', create_function('', 'return register_widget("WP_Flickr_Badge");'));
add_action('wp_footer', create_function('', 'echo \'<link rel="stylesheet" type="text/css" href="'.plugins_url('/css/wp-flickr-badge.css',__FILE__).'" />
	<script type="text/javascript" src="'.plugins_url('/js/wp-flickr-badge.js',__FILE__).'"></script>\';'));
?>