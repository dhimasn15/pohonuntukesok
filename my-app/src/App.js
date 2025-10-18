Sure, here's the content for the file `/my-app/my-app/src/App.js`:

import React from 'react';
import Navbar from './components/Navbar';
import Home from './components/Home';
import './styles/Navbar.css';
import './styles/Home.css';

const App = () => {
    return (
        <div>
            <Navbar />
            <Home />
        </div>
    );
};

export default App;