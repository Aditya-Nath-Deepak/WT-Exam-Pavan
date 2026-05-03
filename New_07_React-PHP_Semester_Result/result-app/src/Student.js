import React from 'react';

function Student({ name, course, marks }) {
  return (
    <div>
      <h2>Student Details</h2>
      <p><strong>Name:</strong> {name || "N/A"}</p>
      <p><strong>Course:</strong> {course || "N/A"}</p>
      
      <table border="1">
        <thead>
          <tr>
            <th>Subject</th>
            <th>MSE (30%)</th>
            <th>ESE (70%)</th>
            <th>Total (100)</th>
          </tr>
        </thead>
        <tbody>
          {Object.keys(marks).map((sub, idx) => {
            const total = marks[sub].mse + marks[sub].ese;
            return (
              <tr key={sub}>
                <td>Subject {idx + 1}</td>
                <td>{marks[sub].mse}</td>
                <td>{marks[sub].ese}</td>
                <td>{total}</td>
              </tr>
            );
          })}
        </tbody>
      </table>
    </div>
  );
}

export default Student;