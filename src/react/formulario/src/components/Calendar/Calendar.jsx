import React, { useEffect, useState } from 'react';
import { Calendar as fullcalendar } from 'fullcalendar';
import './fullcalendar.min.css';

const Calendar = ({ selectedEvent }) => {
	const [event, setEvent] = useState([]);

	useEffect(
		() => {
			selectedEvent(event);
		},
		[event]
	);

	useEffect(() => {
		var calendarEl = document.getElementById('calendar');

		var calendar = new fullcalendar(calendarEl, {
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			buttonText: {
				prev: 'Ant',
				next: 'Sig',
				today: 'Hoy',
				month: 'Mes',
				week: 'Semana',
				day: 'Día',
				list: 'Agenda'
			},
			weekLabel: 'Sm',
			allDayHtml: 'Todo<br/>el día',
			eventLimitText: 'más',
			noEventsMessage: 'No hay eventos para mostrar',
			week: { dow: 1, doy: 4 },
			locale: 'es',
			// defaultDate: Date.now(),
			defaultDate: '2018-12-12',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			height: 650,
			eventClick: function(info) {
				setEvent(info.event.title);
			},
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
	}, []);

	return <div id="calendar" />;
};

export default Calendar;
