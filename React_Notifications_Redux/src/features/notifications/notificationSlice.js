import { createSlice, nanoid } from '@reduxjs/toolkit';

const notificationSlice = createSlice({
  name: 'notifications',
  initialState: [],
  reducers: {
    addNotification: {
      reducer(state, action) {
        state.push(action.payload);
      },
      prepare(message) {
        return {
          payload: {
            id: nanoid(),
            message,
            dismissed: false   // 🔥 NEW
          },
        };
      },
    },

    removeNotification(state, action) {
      return state.filter(n => n.id !== action.payload);
    },

    // 🔥 NEW: Dismiss (hide only)
    dismissNotification(state, action) {
      const notif = state.find(n => n.id === action.payload);
      if (notif) notif.dismissed = true;
    }
  },
});

export const {
  addNotification,
  removeNotification,
  dismissNotification
} = notificationSlice.actions;

export default notificationSlice.reducer;