import React, { useEffect, useState } from 'react';
import { Calendar as fullcalendar } from 'fullcalendar';
import '../../../node_modules/fullcalendar/dist/plugins/rrule.js';
import './fullcalendar.min.css';
import API from '../../config/config';

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
			defaultDate: Date.now(),
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			height: 650,
			events: eventos,
			eventClick: function(info) {
				API.post('admin/availabilityBook', {
					venue: 1,
					start: info.event.start.toLocaleString()
				})
					.then((response) => {
						console.log(response);
					})
					.catch((error) => {
						console.log(error);
					});
				setEvent(
					info.event.start.toLocaleString() +
						'|' +
						info.event.end.toLocaleString()
				);
			},
			eventRender: function(info) {
				if (
					info.event.start.toLocaleString() === '21/1/2019 11:00:00'
				) {
					return false;
				}
			}
		});

		calendar.render();
	}, []);

	return <div id="calendar" />;
};

export default Calendar;
