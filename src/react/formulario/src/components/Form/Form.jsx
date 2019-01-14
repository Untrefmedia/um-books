import React, { useState, useEffect } from 'react';
import { Formik, Field, Form, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import Calendar from '../Calendar/Calendar';

const Formulario = () => {
	const [evento, setEvent] = useState('');

	const handleEvent = (value) => {
		setEvent(value);
	};

	return (
		<div>
			<Calendar selectedEvent={handleEvent} />

			<Formik
				initialValues={{ user: 'pablo', selectedEvent: '' }}
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

					return (
						<Form>
							<Field type="text" name="user" />
							<ErrorMessage name="user" component="div" />

							<Field
								type="hidden"
								name="selectedEvent"
								value={evento}
							/>

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
