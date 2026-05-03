import React from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { removeNotification } from './notificationSlice';

const NotificationList = () => {
  const notifications = useSelector((state) => state.notifications);
  const dispatch = useDispatch();

  return (
    <div style={styles.container}>
      {notifications.length === 0 && <p>No notifications</p>}

      {notifications.map((n) => (
        <div key={n.id} style={styles.notification}>
          <span>{n.message}</span>

          <button
            style={styles.close}
            onClick={() => dispatch(removeNotification(n.id))}
          >
            ✖
          </button>
        </div>
      ))}
    </div>
  );
};

const styles = {
  container: {
    position: 'fixed',
    top: 20,
    right: 20,
    width: '300px',
  },
  notification: {
    background: '#333',
    color: '#fff',
    padding: '12px',
    marginBottom: '10px',
    borderRadius: '6px',
    display: 'flex',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  close: {
    background: 'red',
    border: 'none',
    color: 'white',
    cursor: 'pointer',
    padding: '4px 8px',
  },
};

export default NotificationList;