============================================================
SIMPLE CLOCK & THEME TOGGLE
============================================================

This project focuses on a clean UI and core React hooks.

------------------------------------------------------------
1. COMMANDS
------------------------------------------------------------
- npm install vite@latest
Install dependencies: npm install
Run local server:     npm run dev

------------------------------------------------------------
2. PROJECT LOGIC
------------------------------------------------------------
- THEME TOGGLE: 
  Uses 'useState' to switch between 'light' and 'dark' strings. 
  These strings map to CSS variables in App.css, changing 
  the colors of the entire app instantly.

- DIGITAL CLOCK: 
  Uses 'useEffect' to initiate a setInterval. Every 1000ms, 
  the 'time' state is updated with a new Date() object. 
  This causes the component to re-render and show the 
  current seconds.

- FORMATTING:
  Uses 'padStart(2, "0")' to ensure that single-digit 
  numbers (like 9 seconds) are displayed as "09".

------------------------------------------------------------
3. VISIBILITY FIX
------------------------------------------------------------
The seconds are now part of the main digital-display flex 
container, ensuring they are sized identically to hours 
and minutes for perfect visibility.
============================================================