. Develop a React-based Student Feedback Form that allows users to submit feedback about a course or session. Tasks: 1. Create a Feedback Form with Validation 2. Handle controlled components.(Use useState()) 3. Use useRef() to access DOM elements. 4. Render list items using Keys. 5. Display Submitted Feedback

============================================================
STUDENT FEEDBACK SYSTEM (REACT)
============================================================

A comprehensive React application demonstrating form handling, 
validation, and DOM manipulation using modern Hooks.

------------------------------------------------------------
1. PROJECT INITIALIZATION
------------------------------------------------------------
To start a new project with Vite, run:
   npm install vite@latest

To install local project dependencies:
   npm install

------------------------------------------------------------
2. EXECUTION COMMANDS
------------------------------------------------------------

[ DEVELOPMENT ]
   npm run dev

[ BUILD ]
   npm run build

------------------------------------------------------------
3. IMPLEMENTED CONCEPTS
------------------------------------------------------------
- CONTROLLED COMPONENTS: 
  The form inputs are synced with a single 'formData' state 
  object using the 'useState' hook.

- DOM ACCESS (useRef):
  'useRef' is used to target the Student Name input field. 
  It automatically focuses the field on page load and 
  returns focus to the field after every submission.

- LISTS AND KEYS:
  Feedback submissions are stored in an array. They are 
  rendered as a list where each <li> has a unique 'key' 
  assigned using Date.now() to ensure React handles 
  re-rendering efficiently.

- VALIDATION:
  A simple logic check ensures no field is left empty 
  before the feedback is added to the list.

------------------------------------------------------------
4. FEATURES
------------------------------------------------------------
- Immediate UI feedback via Toast notifications.
- Dynamic list updates (newest feedback appears at top).
- Responsive, clean CSS grid/flex layout.
============================================================