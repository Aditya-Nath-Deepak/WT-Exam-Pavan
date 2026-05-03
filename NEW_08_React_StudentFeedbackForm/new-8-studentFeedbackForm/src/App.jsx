import React, { useState, useRef, useEffect } from 'react';
import './App.css';

const App = () => {
  // 2. Controlled components using useState
  const [formData, setFormData] = useState({
    studentName: '',
    rating: '',
    comment: ''
  });

  // 4. State to store the list of feedback items
  const [feedbackList, setFeedbackList] = useState([]);
  const [toast, setToast] = useState({ show: false, message: '' });

  // 3. useRef to access DOM elements (e.g., for focusing input)
  const nameInputRef = useRef(null);

  // Focus the name field on initial mount
  useEffect(() => {
    nameInputRef.current.focus();
  }, []);

  const showToast = (msg) => {
    setToast({ show: true, message: msg });
    setTimeout(() => setToast({ show: false, message: '' }), 3000);
  };

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  // 1. Form Validation and Submission
  const handleSubmit = (e) => {
    e.preventDefault();

    // Basic Validation
    if (!formData.studentName || !formData.rating || !formData.comment) {
      showToast("Error: Please fill in all fields!");
      return;
    }

    const newFeedback = {
      ...formData,
      id: Date.now() // Unique ID for Keys
    };

    setFeedbackList([newFeedback, ...feedbackList]);
    
    // Reset form and focus back to name using Ref
    setFormData({ studentName: '', rating: '', comment: '' });
    nameInputRef.current.focus();
    showToast("Feedback submitted successfully!");
  };

  return (
    <div className="feedback-container">
      <h1>Student Feedback Form</h1>

      <form className="feedback-form" onSubmit={handleSubmit}>
        <div className="form-group">
          <label>Student Name:</label>
          <input
            type="text"
            name="studentName"
            ref={nameInputRef}
            value={formData.studentName}
            onChange={handleInputChange}
            placeholder="Enter your name"
          />
        </div>

        <div className="form-group">
          <label>Course Rating (1-5):</label>
          <select name="rating" value={formData.rating} onChange={handleInputChange}>
            <option value="">Select Rating</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Very Good</option>
            <option value="3">3 - Good</option>
            <option value="2">2 - Fair</option>
            <option value="1">1 - Poor</option>
          </select>
        </div>

        <div className="form-group">
          <label>Comments:</label>
          <textarea
            name="comment"
            value={formData.comment}
            onChange={handleInputChange}
            placeholder="Tell us what you think..."
          />
        </div>

        <button type="submit" className="submit-btn">Submit Feedback</button>
      </form>

      {/* 5. Display Submitted Feedback */}
      <div className="feedback-results">
        <h2>Recent Submissions</h2>
        {feedbackList.length === 0 ? (
          <p className="empty-msg">No feedback submitted yet.</p>
        ) : (
          <ul className="feedback-list">
            {/* 4. Render list items using Keys */}
            {feedbackList.map((item) => (
              <li key={item.id} className="feedback-item">
                <div className="item-header">
                  <strong>{item.studentName}</strong>
                  <span className="rating-badge">⭐ {item.rating}/5</span>
                </div>
                <p className="item-comment">"{item.comment}"</p>
              </li>
            ))}
          </ul>
        )}
      </div>

      {toast.show && <div className="toast">{toast.message}</div>}
    </div>
  );
};

export default App;