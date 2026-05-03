============================================================
REDUX PRODUCT FILTERING SYSTEM
============================================================

This application demonstrates Global State Management using 
Redux Toolkit to filter products by category and price range.

------------------------------------------------------------
1. PREREQUISITES
------------------------------------------------------------
Ensure you have the following installed:
- Node.js
- Packages: @reduxjs/toolkit, react-redux

------------------------------------------------------------

- npm install vite@latest     : for project creation

2. INSTALLATION
------------------------------------------------------------
Run this command in the project root:

    npm install @reduxjs/toolkit react-redux

------------------------------------------------------------
3. EXECUTION COMMANDS
------------------------------------------------------------

[ DEVELOPMENT ]
Starts the development server:
    npm run dev

[ PRODUCTION ]
Builds the production-ready app:
    npm run build

------------------------------------------------------------
4. HOW IT WORKS (REDUX FLOW)
------------------------------------------------------------
1. STORE: Holds the initial list of products and current 
   filter values (categoryFilter and maxPrice).
2. SLICE: Contains reducers (setCategory, setPrice) that 
   update the state based on user input.
3. SELECTORS: The App uses 'useSelector' to listen for state 
   changes and 'useDispatch' to trigger them.
4. LOGIC: Filtering is performed dynamically in the 
   component using the latest values from the Redux store.

------------------------------------------------------------
5. FEATURES
------------------------------------------------------------
- CATEGORY FILTER: Dropdown to show specific groups.
- PRICE RANGE: Slider to filter items by maximum price.
- TOAST FEEDBACK: Notification appears whenever a filter 
  is modified.
============================================================