import React, { useState, useEffect } from 'react';
import './App.css';

const App = () => {
  // TASK 2 & 5: useState with persistence logic for refresh/re-render
  const [theme, setTheme] = useState(() => {
    return localStorage.getItem('theme-preference') || 'light';
  });

  // TASK 5: Persist theme selection
  useEffect(() => {
    localStorage.setItem('theme-preference', theme);
  }, [theme]);

  // TASK 1: Toggle function
  const toggleTheme = () => {
    setTheme((prev) => (prev === 'light' ? 'dark' : 'light'));
  };

  return (
    /* TASK 3: Change colors dynamically via class */
    <div className={`container ${theme}`}>
      <div className="card">
        <h1>{theme.toUpperCase()} MODE</h1>
        <p>Full Stack Developer Workspace</p>
        
        {/* TASK 1: Toggle button */}
        <button className="btn" onClick={toggleTheme}>
          Toggle Theme
        </button>
      </div>
    </div>
  );
};

export default App;