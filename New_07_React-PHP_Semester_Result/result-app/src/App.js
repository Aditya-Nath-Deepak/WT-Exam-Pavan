import React, { useState } from 'react';
import Student from './Student';
import Result from './Result';

function App() {
  // Task 3: Manage component State using useState()
  const [name, setName] = useState('');
  const [course, setCourse] = useState('');
  const [marks, setMarks] = useState({
    sub1: { mse: 0, ese: 0 },
    sub2: { mse: 0, ese: 0 },
    sub3: { mse: 0, ese: 0 },
    sub4: { mse: 0, ese: 0 }
  });

  const handleMarkChange = (subject, examType, value) => {
    setMarks(prevMarks => ({
      ...prevMarks,
      [subject]: {
        ...prevMarks[subject],
        [examType]: Number(value)
      }
    }));
  };

  const saveToDatabase = async () => {
    // Calculate final status and percentage before sending
    let totalMarks = 0;
    let isFail = false;
    
    Object.keys(marks).forEach(sub => {
      const total = marks[sub].mse + marks[sub].ese;
      totalMarks += total;
      if (total < 40) isFail = true; // Assuming 40/100 is passing
    });

    const payload = {
      name: name,
      course: course,
      percentage: (totalMarks / 400) * 100,
      status: isFail ? "FAIL" : "PASS"
    };

    // Send data to PHP
    const response = await fetch('http://localhost/backend/save_result.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    
    const result = await response.json();
    alert(result.message || result.error);
  };

  return (
    <div>
      <h1>VIT Semester Result Generator</h1>
      
      <div>
        <label>Student Name: </label>
        <input type="text" onChange={(e) => setName(e.target.value)} />
      </div>
      <br />
      <div>
        <label>Course: </label>
        <input type="text" onChange={(e) => setCourse(e.target.value)} />
      </div>
      <br />

      <h3>Enter Marks (MSE out of 30, ESE out of 70)</h3>
      {['sub1', 'sub2', 'sub3', 'sub4'].map((sub, idx) => (
        <div key={sub}>
          <label>Subject {idx + 1} - MSE: </label>
          <input type="number" max="30" onChange={(e) => handleMarkChange(sub, 'mse', e.target.value)} />
          <label> ESE: </label>
          <input type="number" max="70" onChange={(e) => handleMarkChange(sub, 'ese', e.target.value)} />
          <br /><br />
        </div>
      ))}

      <button onClick={saveToDatabase}>Save Result to Database</button>
      
      <hr />

      {/* Task 2: Pass data from parent to child using Props */}
      <Student name={name} course={course} marks={marks} />
      <Result marks={marks} />
    </div>
  );
}

export default App;