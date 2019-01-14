import React, { useState, useEffect } from 'react';
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import Calendar from '../Calendar/Calendar';
import { FormGroup, Col } from 'react-bootstrap';

const Formulario = () => {
	const [evento, setEvent] = useState('');

	const handleEvent = (value) => {
		setEvent(value);
	};

	return (
		<div>
			<Calendar selectedEvent={handleEvent} />

			<Formik
				initialValues={{
					name: '',
					surname: '',
					venue: '',
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
				onSubmit={(values, { setSubmitting }) => {
					setTimeout(() => {
						alert(JSON.stringify(values, null, 2));
						setSubmitting(false);
					}, 500);
				}}
				// validationSchema={Yup.object().shape({
				// email: Yup.string()
				// 	.email()
				// 	.required('Required')
				// })}
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
					values.venue = 'hardcodeado';

					return (
						<Form>
							<FormGroup>
								<Col xs={2}>Nombre</Col>
								<Col xs={10}>
									<input
										id="name"
										type="text"
										value={values.name}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.name && touched.name
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>Apellido</Col>
								<Col xs={10}>
									<input
										id="surname"
										type="text"
										value={values.surname}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.surname && touched.surname
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>Institución: Nombre</Col>
								<Col xs={10}>
									<input
										id="institution_name"
										type="text"
										value={values.institution_name}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.institution_name &&
											touched.institution_name
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>
									Institución: Responsable (nombre y apellido)
								</Col>
								<Col xs={10}>
									<input
										id="institution_responsable"
										type="text"
										value={values.institution_responsable}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.institution_responsable &&
											touched.institution_responsable
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>Institución: Dirección</Col>
								<Col xs={10}>
									<input
										id="institution_address"
										type="text"
										value={values.institution_address}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.institution_address &&
											touched.institution_address
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>Institución: Email</Col>
								<Col xs={10}>
									<input
										id="institution_email"
										type="email"
										value={values.institution_email}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.institution_email &&
											touched.institution_email
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>Institución: Teléfono</Col>
								<Col xs={10}>
									<input
										id="institution_phone"
										type="text"
										value={values.institution_phone}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.institution_phone &&
											touched.institution_phone
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>Institución: Localidad</Col>
								<Col xs={10}>
									<input
										id="institution_city"
										type="text"
										value={values.institution_city}
										onChange={handleChange}
										onBlur={handleBlur}
										className={
											errors.institution_city &&
											touched.institution_city
												? 'text-input error'
												: 'text-input'
										}
									/>
								</Col>
							</FormGroup>

							<FormGroup>
								<Col xs={2}>Institución: Ubicación</Col>
								<Col xs={10}>
									<select id="institution_location">
										<option value="caba">CABA</option>
										<option value="gba">
											Gran Buenos Aires
										</option>
										<option value="interior">
											Interior
										</option>
									</select>
								</Col>
							</FormGroup>

							<button type="submit" disabled={isSubmitting}>
								Submit
							</button>
						</Form>
					);
				}}
			/>
		</div>
	);
};

export default Formulario;
