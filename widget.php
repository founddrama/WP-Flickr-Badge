<?php
/**
 * Plugin Name: WP Flickr Badge
 * Version: 0.1
 * Plugin URI: https://github.com/founddrama/WP-Flickr-Badge
 * Description: Plugin adds the found_drama Flickr Badge to the Orin theme
 * Author: Rob Friesel
 * Author URI: http://blog.founddrama.net
*/
class Orin_Flickr_Badge extends WP_Widget {
	/** constructor */
	function Orin_Flickr_Badge() {
		$widget_ops = array('classname' => 'widget_orin_flickr_badge', 'description' => __('The Orin theme\'s Flickr badge'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('orin_flickr_badge', __('Orin Flickr Badge'), $widget_ops, $control_ops);
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract($args);
		/* 28555778%40N00 */
		$flickr_user = $instance['flickr_user'];
		echo $before_widget;
		if ( $flickr_user ) ?>
				<div id="flickr_badge_uber_wrapper"><div id="flickr_badge_wrapper"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=10&display=random&size=s&layout=x&source=user&user=<?php echo $flickr_user; ?>"></script></div><a href="http://www.flickr.com" id=flickr_www><span id="flickr_www_wrapper">flick<span style="color:#ff1c92;">r</span></span></a></div>
			<?php
			echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['flickr_user'] = $new_instance['flickr_user'];
		return $instance;
	}
	
	function form($instance) {
		$flickr_user = esc_attr($instance['flickr_user']);
		?>
			<p><label for="<?php echo $this->get_field_id('flickr_user'); ?>"><?php _e('Flickr User ID:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_user'); ?>" name="<?php echo $this->get_field_name('flickr_user'); ?>" type="text" value="<?php echo $flickr_user; ?>" /></label></p>
		<?php
	}
	
}

add_action('widgets_init', create_function('', 'return register_widget("Orin_Flickr_Badge");'));
add_action('wp_footer', create_function('', 'echo \'<link rel="stylesheet" type="text/css" href="'.plugins_url('/css/wp-flickr-badge.css',__FILE__).'" />
	<script type="text/javascript" src="'.plugins_url('/js/wp-flickr-badge.js',__FILE__).'"></script>\';'));
?>