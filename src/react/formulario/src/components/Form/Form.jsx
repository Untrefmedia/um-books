import React, { useState, useEffect } from 'react';
import { Formik, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import Calendar from '../Calendar/Calendar';
import { FormGroup, Col } from 'react-bootstrap';
import API from '../../config/config';

const Formulario = ({ venueId = 1, capacityGroup = 35 }) => {
	// Evento es la fecha del calendario (evento elegido)
	const [evento, setEvent] = useState('');
	const [verTurnoElegido, setVerTurnoElegido] = useState([]);
	let [capacityTurn, setCapacityTurn] = useState(0);

	const handleEvent = (value) => {
		setEvent(value);
	};

	const handleCapacityTurn = (value) => {
		setCapacityTurn(value);
	};

	useEffect(
		() => {
			if (typeof evento === 'string') {
				setVerTurnoElegido(evento.split('|'));
			}
		},
		[evento]
	);

	let Validacion = Yup.object().shape({
		name: Yup.string().required('Obligatorio'),
		// surname: Yup.string().required('Obligatorio'),
		// venue: Yup.string().required('Obligatorio'),
		selectedEvent: Yup.string().required('Obligatorio'),
		// institution_name: Yup.string().required('Obligatorio'),
		// institution_responsable: Yup.string().required('Obligatorio'),
		// institution_address: Yup.string().required('Obligatorio'),
		// institution_email: Yup.string()
		// 	.email('Ingrese un email válido')
		// 	.required('Obligatorio'),
		// institution_phone: Yup.string().required('Obligatorio'),
		// institution_city: Yup.string().required('Obligatorio'),
		// institution_location: Yup.string().required('Obligatorio'),
		// institution_type: Yup.string().required('Obligatorio'),
		// institution_dependency: Yup.string().required('Obligatorio'),
		// group_level: Yup.string().required('Obligatorio'),
		// group_course: Yup.string().required('Obligatorio'),
		// group_numberOfStudents: Yup.number().required('Obligatorio'),
		// group_numberOfCompanions: Yup.number().required('Obligatorio'),
		// teacher_name: Yup.string().required('Obligatorio'),
		// teacher_email: Yup.string()
		// 	.email('Ingrese un email válido')
		// 	.required('Obligatorio'),
		// teacher_phone: Yup.string().required('Obligatorio'),
		// teacher_subject: Yup.string().required('Obligatorio'),
		numberOfGroupMembers: Yup.number()
			.required('Obligatorio')
			.max(capacityGroup)
			.test(
				'capacity-turn',
				'Para el turno elegido, puede ingresar hasta ' +
					capacityTurn +
					' personas',
				(value) => value <= capacityTurn
			)

		// response.responseText === 'true'
		// purpose: Yup.string().required('Obligatorio'),
		// language: Yup.string().required('Obligatorio'),
		// know: Yup.string().required('Obligatorio'),
		// comments: Yup.string().required('Obligatorio')
	});

	return (
		<div>
			<Calendar
				getSelectedEvent={handleEvent}
				venueId={venueId}
				getCapacityTurn={handleCapacityTurn}
			/>

			{evento.length > 0 ? (
				<Formik
					initialValues={{
						name: '',
						surname: '',
						venue_id: venueId,
						selectedEvent: '',
						institution_name: '',
						institution_responsable: '',
						institution_address: '',
						institution_email: '',
						institution_phone: '',
						institution_city: '',
						institution_location: '',
						institution_type: '',
						institution_dependency: '',
						group_level: '',
						group_course: '',
						group_numberOfStudents: '',
						group_numberOfCompanions: '',
						teacher_name: '',
						teacher_email: '',
						teacher_phone: '',
						teacher_subject: '',
						numberOfGroupMembers: '',
						purpose: '',
						language: '',
						know: '',
						comments: ''
					}}
					validationSchema={Validacion}
					onSubmit={(values, { setSubmitting }) => {
						API.post('admin/book', {
							values
						})
							.then((response) => {
								if (response.data) {
									alert('reservado: ' + verTurnoElegido[0]);
								}
							})
							.catch((error) => {
								console.log(error);
							});
					}}
					render={({
						values,
						touched,
						errors,
						dirty,
						isSubmitting,
						handleChange,
						handleBlur,
						handleSubmit,
						handleReset
					}) => {
						// Setea el campo del Calendar
						values.selectedEvent = evento;

						return (
							<Form>
								<FormGroup>
									<Col xs={2}>Turno elegido</Col>
									<Col xs={10}>
										<span>{verTurnoElegido[0]}</span>
										<ErrorMessage
											name="selectedEvent"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Nombre</Col>
									<Col xs={10}>
										<input
											name="name"
											type="text"
											value={values.name}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="name"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Apellido</Col>
									<Col xs={10}>
										<input
											name="surname"
											type="text"
											value={values.surname}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="surname"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Nombre</Col>
									<Col xs={10}>
										<input
											name="institution_name"
											type="text"
											value={values.institution_name}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="institution_name"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>
										Institución: Responsable (nombre y
										apellido)
									</Col>
									<Col xs={10}>
										<input
											name="institution_responsable"
											type="text"
											value={
												values.institution_responsable
											}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="institution_responsable"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Dirección</Col>
									<Col xs={10}>
										<input
											name="institution_address"
											type="text"
											value={values.institution_address}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="institution_address"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Email</Col>
									<Col xs={10}>
										<input
											name="institution_email"
											type="text"
											value={values.institution_email}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="institution_email"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Teléfono</Col>
									<Col xs={10}>
										<input
											name="institution_phone"
											type="text"
											value={values.institution_phone}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="institution_phone"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Localidad</Col>
									<Col xs={10}>
										<input
											name="institution_city"
											type="text"
											value={values.institution_city}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="institution_city"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Ubicación</Col>
									<Col xs={10}>
										<select
											name="institution_location"
											value={values.institution_location}
											onChange={handleChange}
											onBlur={handleBlur}
										>
											<option
												value=""
												label="Seleccionar ubicación"
											/>
											<option value="caba" label="CABA" />
											<option
												value="gba"
												label="Gran Buenos Aires"
											/>

											<option
												value="interior"
												label="Interior"
											/>
										</select>
										<ErrorMessage
											name="institution_location"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Tipo</Col>
									<Col xs={10}>
										<input
											name="institution_type"
											type="radio"
											value="educativa"
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<label htmlFor="institution_type">
											Educativa
										</label>
										<input
											name="institution_type"
											type="radio"
											value="centro adultos mayores"
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<label htmlFor="institution_type">
											Centro adultos mayores
										</label>
										<input
											name="institution_type"
											type="radio"
											value="fundación"
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<label htmlFor="institution_type">
											Fundación
										</label>
										<input
											name="institution_type"
											type="radio"
											value="otra"
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<label htmlFor="institution_type">
											Otra: (completar)
										</label>
										<ErrorMessage
											name="institution_type"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Institución: Dependencia</Col>
									<Col xs={10}>
										<select
											name="institution_dependency"
											value={
												values.institution_dependency
											}
											onChange={handleChange}
											onBlur={handleBlur}
										>
											<option
												value=""
												label="Seleccionar dependencia"
											/>
											<option
												value="pública"
												label="Pública"
											/>
											<option
												value="privada"
												label="Privada"
											/>
										</select>
										<ErrorMessage
											name="institution_dependency"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Grupo: Nivel</Col>
									<Col xs={10}>
										<select
											name="group_level"
											value={values.group_level}
											onChange={handleChange}
											onBlur={handleBlur}
										>
											<option
												value=""
												label="Seleccionar nivel"
											/>
											<option
												value="jardín"
												label="Jardín"
											/>
											<option
												value="primaria"
												label="Primaria"
											/>
											<option
												value="secundaria"
												label="Secundaria"
											/>
											<option
												value="terciario"
												label="Terciario"
											/>
											<option
												value="universitario"
												label="Universitario"
											/>
										</select>
										<ErrorMessage
											name="group_level"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Grupo: Curso</Col>
									<Col xs={10}>
										<input
											name="group_course"
											type="text"
											value={values.group_course}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="group_course"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Grupo: Cantidad de alumnos</Col>
									<Col xs={10}>
										<input
											name="group_numberOfStudents"
											type="text"
											value={
												values.group_numberOfStudents
											}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="group_numberOfStudents"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>
										Grupo: Cantidad de acompañantes
									</Col>
									<Col xs={10}>
										<input
											name="group_numberOfCompanions"
											type="text"
											value={
												values.group_numberOfCompanions
											}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="group_numberOfCompanions"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Docente: Nombre y apellido</Col>
									<Col xs={10}>
										<input
											name="teacher_name"
											type="text"
											value={values.teacher_name}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="teacher_name"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Docente: Email</Col>
									<Col xs={10}>
										<input
											name="teacher_email"
											type="text"
											value={values.teacher_email}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="teacher_email"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Docente: Teléfono</Col>
									<Col xs={10}>
										<input
											name="teacher_phone"
											type="text"
											value={values.teacher_phone}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="teacher_phone"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>
										Docente: Asignatura que dicta
									</Col>
									<Col xs={10}>
										<input
											name="teacher_subject"
											type="text"
											value={values.teacher_subject}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="teacher_subject"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>
										Cantidad de integrantes del grupo:
									</Col>
									<Col xs={10}>
										<input
											name="numberOfGroupMembers"
											type="text"
											value={values.numberOfGroupMembers}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="numberOfGroupMembers"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Propósito de la visita:</Col>
									<Col xs={10}>
										<textarea
											name="purpose"
											type="text"
											value={values.purpose}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="purpose"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>
										Idioma necesario en la visita:
									</Col>
									<Col xs={10}>
										<input
											name="language"
											type="radio"
											value="español"
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<label htmlFor="language">
											Español
										</label>
										<input
											name="language"
											type="radio"
											value="inglés"
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<label htmlFor="language">Inglés</label>
										<ErrorMessage
											name="language"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Cómo supo del museo:</Col>
									<Col xs={10}>
										<textarea
											name="know"
											type="text"
											value={values.know}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="know"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<FormGroup>
									<Col xs={2}>Comentarios y Preguntas:</Col>
									<Col xs={10}>
										<textarea
											name="comments"
											type="text"
											value={values.comments}
											onChange={handleChange}
											onBlur={handleBlur}
										/>
										<ErrorMessage
											name="comments"
											component="div"
											className="field-error"
										/>
									</Col>
								</FormGroup>

								<button type="submit" disabled={isSubmitting}>
									Submit
								</button>
							</Form>
						);
					}}
				/>
			) : (
				''
			)}
		</div>
	);
};

export default Formulario;
