<?php
/*
 * List all of the terms in a custom taxonomy
 */
class largo_taxonomy_list_widget extends WP_Widget {

	function largo_taxonomy_list_widget() {
		$widget_ops = array(
			'classname' 	=> 'largo-taxonomy-list',
			'description' 	=> __('List all of the terms in a custom taxonomy with links', 'largo')
		);
		$this->WP_Widget( 'largo-taxonomy-list-widget', __('Largo Taxonomy List', 'largo'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories', 'largo' ) : $instance['title'], $instance, $this->id_base);
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		$widget_class = !empty($instance['widget_class']) ? $instance['widget_class'] : '';
		if ($instance['hidden_desktop'] === 1)
			$widget_class .= ' hidden-desktop';
		if ($instance['hidden_tablet'] === 1)
			$widget_class .= ' hidden-tablet';
		if ($instance['hidden_phone'] === 1)
			$widget_class .= ' hidden-phone';
		/* Add the widget class to $before widget, used as a style hook */
		if( strpos($before_widget, 'class') === false ) {
			$before_widget = str_replace('>', 'class="'. $widget_class . '"', $before_widget);
		}
		else {
			$before_widget = str_replace('class="', 'class="'. $widget_class . ' ', $before_widget);
		}

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$cat_args = array(
				'orderby' 	=> 'name',
				'taxonomy' 	=> $instance['taxonomy'],
				'name'		=> 'term_id',
				'id'		=> 'term_id'
    		);

		if ( $d ) {
			$cats = get_categories($cat_args); ?>

			<select id="taxonomy-list-widget">
				<option value=""><?php printf( __('Select %s', 'largo'), ucwords($instance['taxonomy']) ); ?></option>
			<?php foreach ($cats as $cat) : ?>
				<option value="<?php echo get_term_link($cat, $cat->taxonomy) ?>"><?php echo $cat->name ?></option>
			<?php endforeach; ?>
			</select>

			<script>
				jQuery(document).ready(function() {
				    jQuery('#taxonomy-list-widget').change(function() {
				        window.location = jQuery(this).val();
				    });
				});
			</script>

<?php
		} else {
?>
		<ul>
<?php
		$cat_args['title_li'] = '';
		wp_list_categories(apply_filters('widget_categories_args', $cat_args));
?>
		</ul>
<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['taxonomy'] = strtolower(strip_tags($new_instance['taxonomy']));
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
		$instance['widget_class'] = $new_instance['widget_class'];
		$instance['hidden_desktop'] = $new_instance['hidden_desktop'] ? 1 : 0;
		$instance['hidden_tablet'] = $new_instance['hidden_tablet'] ? 1 : 0;
		$instance['hidden_phone'] = $new_instance['hidden_phone'] ? 1 : 0;
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$taxonomy = esc_attr( $instance['taxonomy'] );
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		$desktop = $instance['hidden_desktop'] ? 'checked="checked"' : '';
		$tablet = $instance['hidden_tablet'] ? 'checked="checked"' : '';
		$phone = $instance['hidden_phone'] ? 'checked="checked"' : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'largo' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:', 'largo'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>" type="text" value="<?php echo $taxonomy; ?>" />
		</p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown', 'largo' ); ?></label></p>

		<label for="<?php echo $this->get_field_id( 'widget_class' ); ?>"><?php _e('Widget Background', 'largo'); ?></label>
		<select id="<?php echo $this->get_field_id('widget_class'); ?>" name="<?php echo $this->get_field_name('widget_class'); ?>" class="widefat" style="width:90%;">
		    <option <?php selected( $instance['widget_class'], 'default'); ?> value="default"><?php _e('Default', 'largo'); ?></option>
		    <option <?php selected( $instance['widget_class'], 'rev'); ?> value="rev"><?php _e('Reverse', 'largo'); ?></option>
		    <option <?php selected( $instance['widget_class'], 'no-bg'); ?> value="no-bg"><?php _e('No Background', 'largo'); ?></option>
		</select>

		<p style="margin:15px 0 10px 5px">
			<input class="checkbox" type="checkbox" <?php echo $desktop; ?> id="<?php echo $this->get_field_id('hidden_desktop'); ?>" name="<?php echo $this->get_field_name('hidden_desktop'); ?>" /> <label for="<?php echo $this->get_field_id('hidden_desktop'); ?>"><?php _e('Hidden on Desktops?', 'largo'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" <?php echo $tablet; ?> id="<?php echo $this->get_field_id('hidden_tablet'); ?>" name="<?php echo $this->get_field_name('hidden_tablet'); ?>" /> <label for="<?php echo $this->get_field_id('hidden_tablet'); ?>"><?php _e('Hidden on Tablets?', 'largo'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" <?php echo $phone; ?> id="<?php echo $this->get_field_id('hidden_phone'); ?>" name="<?php echo $this->get_field_name('hidden_phone'); ?>" /> <label for="<?php echo $this->get_field_id('hidden_phone'); ?>"><?php _e('Hidden on Phones?', 'largo'); ?></label>
		</p>

<?php
	}

}
