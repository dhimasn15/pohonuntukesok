Sure, here's the content for the file `/my-app/my-app/src/index.js`:

import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import './styles/Navbar.css';
import './styles/Home.css';

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')
);