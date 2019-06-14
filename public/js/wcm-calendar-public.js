(function( $ ) {
	'use strict';

	$(document).ready(function() {

		$('.widget_wcm_calendar_widget .wcm_calendar_events').each(function(index, widget) {
			var $widget = $(widget),
			calendarId = $widget.data('calendarid');

			console.log("WCM Calendar Widget - Getting events for calendar:", calendarId);
			$.post(
				wcm_calendar_settings.ajax_url,
				{
					action: 'wcm_calendar_get_events',
					calendarId: calendarId,
				},
				function(response) {
					if (response.success === true) {
						var events = response.data.events,
							output = "<ul>";

						events.slice(0,3).forEach(function(event) {
							var event_start = new Date(event.start);
							var start = zeropad(event_start.getFullYear()) + "-" + zeropad(event_start.getMonth()+1) + "-" + zeropad(event_start.getDate()) + " " + zeropad(event_start.getHours()) + ":" + zeropad(event_start.getMinutes()); // 2018-08-06 09:00

							output += "<li>" + start + " - " + event.summary + "<br /><em>" + event.location + "</em></li>";
						});

						output += "</ul>";
						$widget.html(output);
					}
				}
			);
		});

	});

	function zeropad(str) {
		if (str == 0) {
			return "00";
		} else if (str > 0 && str < 10) {
			return "0" + str;
		}
		return str;
	}

})( jQuery );
