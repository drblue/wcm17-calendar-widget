<?php
/**
 * Adds WCM_Calendar_Widget widget.
 */
class WCM_Calendar_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'WCM_Calendar_Widget', // Base ID
			'WCM Calendar Widget', // Name
			[
				'description' => __('WCM Calendar Widget', 'text_domain'),
			] // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		$title = apply_filters('widget_title', $instance['title']);
		$calendarId = $instance['calendarId'];

		// start widget
		echo $args['before_widget'];

		// widget title
		if (!empty($title)) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		/**
		 * get this weeks events and display them
		 */
		?>
			<div class="wcm_calendar_events" data-calendarId="<?php echo $calendarId; ?>">
				<em>Loading...</em>
			</div>
		<?php

		// end widget
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('This Weeks Calendar', 'text_domain');
		}

		if (isset($instance['calendarId'])) {
			$calendarId = $instance['calendarId'];
		} else {
			$calendarId = __('', 'text_domain');
		}

		?>

			<!-- title -->
			<p>
				<label for="<?php echo $this->get_field_name('title'); ?>">
					<?php _e('Title:'); ?>
				</label>

				<input
					class="widefat"
					id="<?php echo $this->get_field_id('title'); ?>"
					name="<?php echo $this->get_field_name('title'); ?>"
					type="text"
					value="<?php echo esc_attr($title); ?>"
				/>
			</p>

			<!-- city -->
			<p>
				<label for="<?php echo $this->get_field_name('calendarId'); ?>">
					<?php _e('Calendar ID:'); ?>
				</label>

				<input
					class="widefat"
					id="<?php echo $this->get_field_id('calendarId'); ?>"
					name="<?php echo $this->get_field_name('calendarId'); ?>"
					type="text"
					value="<?php echo esc_attr($calendarId); ?>"
				/>
			</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = [];
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['calendarId'] = (!empty($new_instance['calendarId'])) ? strip_tags($new_instance['calendarId']) : 'Lund';

		return $instance;
	}

} // class WCM_Calendar_Widget
