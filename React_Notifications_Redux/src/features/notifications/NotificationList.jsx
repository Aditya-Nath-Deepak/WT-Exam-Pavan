import React from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { removeNotification, dismissNotification } from './notificationSlice';

const NotificationList = () => {
  const notifications = useSelector((state) => state.notifications);
  const dispatch = useDispatch();

  return (
    <div style={styles.container}>
      {notifications.filter(n => !n.dismissed).length === 0 && <p>No notifications</p>}

      {notifications
        .filter(n => !n.dismissed)   // 🔥 Hide dismissed
        .map((n) => (
          <div key={n.id} style={styles.notification}>
            <span>{n.message}</span>

            <div>
              {/* 🔥 Dismiss */}
              <button
                style={styles.dismiss}
                onClick={() => dispatch(dismissNotification(n.id))}
              >
                Dismiss
              </button>

              {/* 🔥 Remove */}
              <button
                style={styles.remove}
                onClick={() => dispatch(removeNotification(n.id))}
              >
                ✖
              </button>
            </div>
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
  dismiss: {
    marginRight: 8,
    background: '#ffc107',
    border: 'none',
    padding: '4px 8px',
    cursor: 'pointer',
  },
  remove: {
    background: 'red',
    border: 'none',
    color: 'white',
    cursor: 'pointer',
    padding: '4px 8px',
  },
};

export default NotificationList;