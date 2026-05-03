import React from 'react';

function Result({ marks }) {
  let totalMarks = 0;
  let isFail = false;

  // Calculate totals and check passing condition (Assumes 40 per subject is passing)
  Object.keys(marks).forEach(sub => {
    const total = marks[sub].mse + marks[sub].ese;
    totalMarks += total;
    if (total < 40) {
      isFail = true; 
    }
  });

  const percentage = (totalMarks / 400) * 100;
  
  // Task 4: Update UI dynamically based on state changes
  const status = isFail ? "FAIL" : "PASS";

  return (
    <div>
      <h2>Final Result</h2>
      <p><strong>Total Marks:</strong> {totalMarks} / 400</p>
      <p><strong>Percentage:</strong> {percentage.toFixed(2)}%</p>
      <p>
        <strong>Status: </strong> 
        {status === "PASS" ? 
          <span>PASSED</span> : 
          <span>FAILED (Needs 40+ in every subject)</span>
        }
      </p>
    </div>
  );
}

export default Result;