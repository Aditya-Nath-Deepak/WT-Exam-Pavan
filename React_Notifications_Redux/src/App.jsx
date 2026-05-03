import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { addNotification } from './features/notifications/notificationSlice';
import NotificationList from './features/notifications/NotificationList.jsx';

function App() {
  const [message, setMessage] = useState('');
  const dispatch = useDispatch();

  const handleAdd = () => {
    if (message.trim() === '') return;
    dispatch(addNotification(message));
    setMessage('');
  };

  return (
    <div style={styles.app}>
      <h2>Notification System</h2>

      <input
        type="text"
        placeholder="Enter notification..."
        value={message}
        onChange={(e) => setMessage(e.target.value)}
        style={styles.input}
      />

      <button onClick={handleAdd} style={styles.button}>
        Add Notification
      </button>

      <NotificationList />
    </div>
  );
}

const styles = {
  app: { padding: 20 },
  input: {
    padding: 10,
    marginRight: 10,
    width: '250px',
  },
  button: {
    padding: 10,
    background: '#007bff',
    color: '#fff',
    border: 'none',
  },
};

export default App;