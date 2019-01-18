import React, { useEffect, useState } from 'react';
import { Calendar as fullcalendar } from 'fullcalendar';
import '../../../node_modules/fullcalendar/dist/plugins/rrule.js'; // need this! or include <script> tag instead
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

		const eventos = [
			{
				title: 'Desde las 10',
				rrule: {
					freq: 'DAILY',
					byweekday: ['mo', 'tu', 'we', 'th', 'fr'],
					dtstart: '2018-12-01T10:00:00'
				},
				duration: '01:00'
			},
			{
				title: 'Desde las 11',
				rrule: {
					freq: 'DAILY',
					byweekday: ['mo', 'tu', 'we', 'th', 'fr'],
					dtstart: '2018-12-01T11:00:00'
				},
				duration: '01:00'
			},
			{
				title: 'Desde las 14',
				rrule: {
					freq: 'DAILY',
					byweekday: ['mo', 'tu', 'we', 'th', 'fr'],
					dtstart: '2018-12-01T14:00:00'
				},
				duration: '01:00'
			},
			{
				title: 'Desde las 15',
				rrule: {
					freq: 'DAILY',
					byweekday: ['mo', 'tu', 'we', 'th', 'fr'],
					dtstart: '2018-12-01T15:00:00'
				},
				duration: '01:00'
			},
			{
				title: 'Desde las 16',
				rrule: {
					freq: 'DAILY',
					byweekday: ['mo', 'tu', 'we', 'th', 'fr'],
					dtstart: '2018-12-01T16:00:00'
				},
				duration: '01:00'
			},
			{
				title: 'Desde las 17',
				rrule: {
					freq: 'DAILY',
					byweekday: ['mo', 'tu', 'we', 'th', 'fr'],
					dtstart: '2018-12-01T17:00:00'
				},
				duration: '01:00'
			},
			{
				title: 'Fin de semana',
				rrule: {
					freq: 'DAILY',
					byweekday: ['sa', 'su'],
					dtstart: '2018-12-01T15:00:00'
				},
				duration: '01:00'
			}
		];

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
				setEvent(info.event.start + '|' + info.event.end);
			},
			events: eventos
		});

		calendar.render();
	}, []);

	return <div id="calendar" />;
};

export default Calendar;
