<?php
/*
Plugin Name: LoL Free Champion Rotation
Plugin URI: https://springforce.co/shop/lol-free-champion-rotation-widget/
Description: This plugin offers a widget that  will show you the weekly free-to-play champions from League of Legends.
Version: 2.2
Author: Spring Force
Text Domain: lol-free-champion-rotation
Author URI: https://springforce.co/
License: GPLv2
*/

class lol_free_champion_rotation extends WP_Widget {

	// constructor
	function lol_free_champion_rotation() {
		parent::WP_Widget(false, $name = __('LoL Free Champion Rotation', 'lol-free-champion-rotation') );
	}
	// widget form creation
	function form($instance) {	
		if( $instance) {
			$title = esc_attr($instance['title']);
			$width = esc_attr($instance['width']);
			$checkbox = esc_attr($instance['checkbox']);
			$lang = esc_attr($instance['lang']);
		} else {
			$title = '';
			$width = '200';
			$checkbox = '1';
			$lang = 'en_US';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lol-free-champion-rotation'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', 'lol-free-champion-rotation'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" placeholder="ex. 200" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Language:', 'lol-free-champion-rotation'); ?></label>
		<select class="widefat" name="<?php echo $this->get_field_name('lang'); ?>" id="<?php echo $this->get_field_id('lang'); ?>">
			<option value="cs_CZ" <?PHP if ($lang == 'cs_CZ') echo 'selected="selected"'; ?>>Czech (Czech Republic)</option>
			<option value="de_DE" <?PHP if ($lang == 'de_DE') echo 'selected="selected"'; ?>>German (Germany)</option>
			<option value="el_GR" <?PHP if ($lang == 'el_GR') echo 'selected="selected"'; ?>>Greek (Greece)</option>
			<option value="en_US" <?PHP if ($lang == 'en_US') echo 'selected="selected"'; ?>>English (United States)</option>
			<option value="es_ES" <?PHP if ($lang == 'es_ES') echo 'selected="selected"'; ?>>Spanish (Spain)</option>
			<option value="fr_FR" <?PHP if ($lang == 'fr_FR') echo 'selected="selected"'; ?>>French (France)</option>
			<option value="hu_HU" <?PHP if ($lang == 'hu_HU') echo 'selected="selected"'; ?>>Hungarian (Hungary)</option>
			<option value="id_ID" <?PHP if ($lang == 'id_ID') echo 'selected="selected"'; ?>>Indonesian (Indonesia)</option>
			<option value="it_IT" <?PHP if ($lang == 'it_IT') echo 'selected="selected"'; ?>>Italian (Italy)</option>
			<option value="ja_JP" <?PHP if ($lang == 'ja_JP') echo 'selected="selected"'; ?>>Japanese (Japan)</option>
			<option value="ko_KR" <?PHP if ($lang == 'ko_KR') echo 'selected="selected"'; ?>>Korean (Korea)</option>
			<option value="ms_MY" <?PHP if ($lang == 'ms_MY') echo 'selected="selected"'; ?>>Malay (Malaysia)</option>
			<option value="pl_PL" <?PHP if ($lang == 'pl_PL') echo 'selected="selected"'; ?>>Polish (Poland)</option>
			<option value="pt_BR" <?PHP if ($lang == 'pt_BR') echo 'selected="selected"'; ?>>Portuguese (Brazil)</option>
			<option value="ro_RO" <?PHP if ($lang == 'ro_RO') echo 'selected="selected"'; ?>>Romanian (Romania)</option>
			<option value="ru_RU" <?PHP if ($lang == 'ru_RU') echo 'selected="selected"'; ?>>Russian (Russia)</option>
			<option value="th_TH" <?PHP if ($lang == 'th_TH') echo 'selected="selected"'; ?>>Thai (Thailand)</option>
			<option value="tr_TR" <?PHP if ($lang == 'tr_TR') echo 'selected="selected"'; ?>>Turkish (Turkey)</option>
			<option value="vn_VN" <?PHP if ($lang == 'vn_VN') echo 'selected="selected"'; ?>>Vietnamese (Viet Nam)</option>
			<option value="zh_CN" <?PHP if ($lang == 'zh_CN') echo 'selected="selected"'; ?>>Chinese (China)</option>
		</select>
		</p>
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php _e( 'Give credit to Author', 'lol-free-champion-rotation' ); ?></label>
		</p>
	 	<?PHP
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['checkbox'] = strip_tags($new_instance['checkbox']);
		$instance['lang'] = strip_tags($new_instance['lang']);
		return $instance;
	}
	// widget display
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$width = $instance['width'];
		$lang = 'en_US';
		if ($instance['lang'])
			$lang = $instance['lang'];
		if (!is_numeric($width)) {
			$width = 250;
		} 		
		$height = $width*2/5;
		$checkbox = $instance['checkbox'];
		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text sf-lol-free-champion-rotation" id="sf-lol-box" style="max-width:'.$width.'px;">';
		// Check if title is set
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		?>
		<iframe id="sf-lol-iframe" src="https://api.springforce.co/wp/lol-free-champion-rotation/?lang=<?PHP echo $lang; ?>"></iframe>
		<script type="text/javascript">
			(function() {
				document.getElementById("sf-lol-iframe").style.height = (document.getElementById("sf-lol-box").offsetWidth * 2/5) + "px";
			})();
		</script>
		<?PHP
		if ($checkbox == '1')
			echo '<div class="sf-author">by <a href="https://springforce.co/shop/lol-free-champion-rotation-widget/" target="_blank" rel="nofollow">Spring Force</a></div>';
		echo '</div>';
		echo $after_widget;	
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("lol_free_champion_rotation");'));

// add stylesheet to the page
function safely_add_stylesheet() {
	wp_enqueue_style( 'prefix-style', plugins_url('data/style.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'safely_add_stylesheet' );
?>