import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App/App';
import * as serviceWorker from './serviceWorker';

const rootElement = document.getElementById('root');

const venueId = rootElement.getAttribute('data-venueId');
const capacityGroup = rootElement.getAttribute('data-capacityGroup');

ReactDOM.render(
	<App venueId={venueId} capacityGroup={capacityGroup} />,
	rootElement
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: http://bit.ly/CRA-PWA
serviceWorker.unregister();
