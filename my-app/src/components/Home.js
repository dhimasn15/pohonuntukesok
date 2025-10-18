import React from 'react';
import './Home.css';

const Home = () => {
    return (
        <div className="home-container">
            <h1>Welcome to Our App!</h1>
            <p>Explore our features and enjoy your stay.</p>
            <button className="cta-button">Get Started</button>
            <div className="interactive-section">
                <h2>Interactive Features</h2>
                <p>Check out our latest updates and interactive content!</p>
                <button className="feature-button">Learn More</button>
            </div>
        </div>
    );
};

export default Home;