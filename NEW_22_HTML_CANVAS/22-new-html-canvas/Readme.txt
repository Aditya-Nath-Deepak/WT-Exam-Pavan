============================================================
CANVAS SHAPE DRAWER
============================================================

A responsive HTML5 Canvas application that allows users to 
draw lines and rectangles using mouse click events.

------------------------------------------------------------
1. INSTALLATION & SETUP
------------------------------------------------------------

To run the project:
Simply open 'index.html' in any modern web browser.

------------------------------------------------------------
2. HOW TO USE
------------------------------------------------------------
1. Open the application.
2. Select a tool from the top menu (Line or Rectangle).
3. Click once on the canvas to set the "Start Point".
4. Click a second time anywhere else to set the "End Point".
5. The selected shape will be drawn immediately.
6. Use the 'Clear Canvas' button to reset the drawing area.

------------------------------------------------------------
3. KEY FEATURES
------------------------------------------------------------
- RESPONSIVE DESIGN: The canvas automatically resizes to 
  fit the browser window using the 'resize' event listener.
- EVENT HANDLING: Uses 'mousedown' and coordinate mapping 
  to track user clicks accurately relative to the canvas.
- DRAWING API: Uses the CanvasRenderingContext2D methods:
    * moveTo/lineTo for Lines.
    * strokeRect for Rectangles.
    * arc for start-point indicators.

------------------------------------------------------------
4. COMMANDS SUMMARY
------------------------------------------------------------
- Open index.html     : View application directly.
============================================================