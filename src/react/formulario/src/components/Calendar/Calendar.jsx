import React, { useEffect, useState } from 'react';
import { Calendar as fullcalendar } from 'fullcalendar';
import './fullcalendar.min.css';
import API from '../../config/config';

const Calendar = ({
	getSelectedEvent,
	venueId,
	capacityGroup,
	getCapacityTurn
}) => {
	// evento elegido en el calendario, para input del formulario
	const [event, setEvent] = useState([]);
	// listado de turnos para rellenar el calendario
	const [turnos, setTurnos] = useState({ status: false, turnos: [] });

	let [disponibilidadTurno, setDisponibilidadTurno] = useState(capacityGroup);

	// retorna el evento elegido
	useEffect(
		() => {
			getSelectedEvent(event);
		},
		[event]
	);

	// retorna la capacidad disponible en el turno
	useEffect(
		() => {
			getCapacityTurn(disponibilidadTurno);
		},
		[disponibilidadTurno]
	);

	// traae los eventos para cargar en el calendario
	useEffect(() => {
		API.post('admin/getEvents', { venueId })
			.then((response) => {
				setTurnos({ status: true, turnos: [...response.data] });
			})
			.catch((error) => {
				console.log(error);
			});
	}, []);

	useEffect(
		() => {
			if (turnos.status) {
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
					defaultDate: Date.now(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					height: 650,
					events: turnos.turnos,
					eventClick: function(info) {
						API.post('admin/availabilityBook', {
							venue: venueId,
							start: info.event.start.toLocaleString('en-GB', {
								timeZone: 'America/Winnipeg'
							})
						})
							.then((response) => {
								setDisponibilidadTurno(
									response.data.capacidad_turno_disponible
								);

								if (
									response.data.disponibilidad ===
									'disponible'
								) {
									let turnoElegido =
										info.event.start.toLocaleString(
											'en-GB',
											{
												timeZone: 'America/Winnipeg'
											}
										) +
										'|' +
										info.event.end.toLocaleString('en-GB', {
											timeZone: 'America/Winnipeg'
										});

									setEvent(turnoElegido);
								} else {
									alert('fecha no disponible');
								}
							})
							.catch((error) => {
								console.log(error);
							});
					}
				});

				calendar.render();
			}
		},
		[turnos]
	);

	return <div id="calendar" />;
};

export default Calendar;
