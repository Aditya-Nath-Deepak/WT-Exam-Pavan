import { configureStore } from '@reduxjs/toolkit';
import notificationReducer from '../features/notifications/notificationSlice';
// this is the redux store 
export const store = configureStore({
  reducer: {
    notifications: notificationReducer,
  },
});