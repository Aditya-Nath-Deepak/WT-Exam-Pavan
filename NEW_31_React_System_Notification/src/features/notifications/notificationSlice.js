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
          },
        };
      },
    },

    removeNotification(state, action) {
      return state.filter(n => n.id !== action.payload);
    },
  },
});

export const { addNotification, removeNotification } = notificationSlice.actions;
export default notificationSlice.reducer;