import React, { useEffect } from 'react';
import { Calendar } from 'fullcalendar';
import './../../fullcalendar/fullcalendar.min.css';

const Calendario = (props) => {
	useEffect(() => {
		var calendarEl = document.getElementById('calendar');
		var calendar = new Calendar(calendarEl, {
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			locale: 'es',
			defaultDate: '2018-12-12',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			height: 650,
			events: [
				{
					title: 'All Day Event',
					start: '2018-12-01'
				},
				{
					title: 'Long Event',
					start: '2018-12-07',
					end: '2018-12-10'
				},
				{
					groupId: 999,
					title: 'Repeating Event',
					start: '2018-12-09T16:00:00'
				},
				{
					groupId: 999,
					title: 'Repeating Event',
					start: '2018-12-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2018-12-11',
					end: '2018-12-13'
				},
				{
					title: 'Meeting',
					start: '2018-12-12T10:30:00',
					end: '2018-12-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2018-12-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2018-12-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2018-12-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2018-12-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2018-12-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2018-12-28'
				}
			]
		});
		calendar.render();

		// console.log(Calendar);
		// $('#calendar').Calendar({
		// 	header: {
		// 		left: 'prev,next today',
		// 		center: 'title',
		// 		right: 'month,agendaWeek,agendaDay'
		// 	},
		// 	editable: true,
		// 	droppable: true, // this allows things to be dropped onto the calendar
		// 	drop: function() {
		// 		// is the "remove after drop" checkbox checked?
		// 		if ($('#drop-remove').is(':checked')) {
		// 			// if so, remove the element from the "Draggable Events" list
		// 			$(this).remove();
		// 		}
		// 	}
		// });
	}, []);

	return <div id="calendar" />;
};

export default Calendario;
