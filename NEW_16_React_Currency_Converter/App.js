import React, { useState } from 'react';

function App() {
  const [dollars, setDollars] = useState('');
  const rate = 83;

  return (
    <div style={{padding: '20px'}}>
      <h2>Currency Converter</h2>
      <input 
        type="number" 
        placeholder="Enter dollars" 
        value={dollars}
        onChange={(e) => setDollars(e.target.value)}
      />
      <p>Rupees: ₹{dollars ? (dollars * rate).toFixed(2) : 0}</p>
    </div>
  );
}

export default App;
