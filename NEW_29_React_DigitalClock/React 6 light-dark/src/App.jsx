import React, { useState, useEffect } from 'react';
import './App.css';

const App = () => {
  const [time, setTime] = useState(new Date());
  const [isRunning, setIsRunning] = useState(true);

  useEffect(() => {
    let timer;
    if (isRunning) {
      timer = setInterval(() => {
        setTime(new Date());
      }, 1000);
    }
    return () => clearInterval(timer);
  }, [isRunning]);

  // Helper to turn time into an array of characters for dynamic sizing
  const getTimeArray = (date) => {
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const seconds = date.getSeconds().toString().padStart(2, '0');
    return `${hours}:${minutes}:${seconds}`.split('');
  };

  return (
    <div className="container">
      {/* The frame width is now dynamic based on its content */}
      <div className="industrial-case">
        <div className="display-screen">
          {getTimeArray(time).map((char, index) => (
            <span 
              key={index} 
              className={char === ':' ? 'separator' : 'digit'}
            >
              {char}
            </span>
          ))}
        </div>
      </div>

      <div className="controls">
        <button 
          className="toggle-btn" 
          onClick={() => setIsRunning(!isRunning)}
        >
          {isRunning ? 'STOP' : 'START'}
        </button>
      </div>
    </div>
  );
};

export default App;