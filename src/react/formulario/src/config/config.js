import axios from 'axios';

export const API_baseURL = 'http://127.0.0.1:8000/';
// export const API_baseURL = process.env.NODE_ENV === 'production' ? 'http://untref.edu.ar/reservas/' : 'http://127.0.0.1:8000/';

const API = axios.create({
	baseURL: API_baseURL
});

export default API;
