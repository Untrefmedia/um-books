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
				enableReinitialized={true}
				onSubmit={(values, { setSubmitting }) => {
					setTimeout(() => {
						alert(JSON.stringify(values, null, 2));
						setSubmitting(false);
					}, 500);
				}}
				validationSchema={Yup.object().shape({
					// email: Yup.string()
					// 	.email()
					// 	.required('Required')
				})}
			>
				{(props) => {
					const {
						values,
						touched,
						errors,
						dirty,
						isSubmitting,
						handleChange,
						handleBlur,
						handleSubmit,
						handleReset
					} = props;

					// Setea el campo del Calendar
					props.values.selectedEvent = evento;

					return (
						<form onSubmit={handleSubmit} id="formu">
							<label htmlFor="user" style={{ display: 'block' }}>
								User
							</label>
							<input
								id="user"
								type="text"
								value={values.user}
								onChange={handleChange}
								onBlur={handleBlur}
								className={
									errors.user && touched.user
										? 'text-input error'
										: 'text-input'
								}
							/>
							{errors.user && touched.user && (
								<div className="input-feedback">
									{errors.user}
								</div>
							)}

							<input
								id="selectedEvent"
								type="hidden"
								value={values.selectedEvent}
								onChange={handleChange}
							/>

							<button
								type="button"
								className="outline"
								onClick={handleReset}
								disabled={!dirty || isSubmitting}
							>
								Reset
							</button>

							<button type="submit" disabled={isSubmitting}>
								Submit
							</button>
						</form>
					);
				}}
			</Formik>
		</div>
	);
};

export default Formulario;
