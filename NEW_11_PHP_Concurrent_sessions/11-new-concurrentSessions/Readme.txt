Design and develop a PHP script to limit the maximum number of concurrent sessions for a user to 3. Set session expiration timeout to 5 minutes

============================================================
PHP CONCURRENT SESSION LIMITER
============================================================

1. SETUP:
   - Ensure PHP 8.x is running.
   - Place index.php and logout.php in the same folder.

2. EXECUTION:
   - Run: php -S localhost:8000
   - Open localhost:8000 in 3 different browsers/incognito windows.
   - Open a 4th window to see the "Max Sessions Reached" screen.

3. RECOVERY LOGIC:
   - When you click "Secure Logout" in an active tab, the script 
     removes that specific Session ID from 'session_tracker.json'.
   - Go back to the 4th (denied) tab and click "Retry Now". 
   - It will now see only 2 active sessions and grant access.

4. AUTOMATIC EXPIRATION:
   - Sessions are automatically pruned if there is no activity 
     for 300 seconds (5 minutes).

5. If Not Working then try:
How to test it now:
-  Delete your existing session_tracker.json file just to start with a clean slate.
-  Open 3 different browsers (e.g., Chrome, Edge, Chrome Incognito).
-  Click "Login" on all 3. They will show 1/3, 2/3, and 3/3.
-  Open a 4th browser and click Login. It will be denied.
-  Go to one of the active tabs and click "Secure Logout". You will be taken to the login screen and stay there.
-  Go back to your 4th browser, click "Back to Login", and log in. It will now work perfectly
============================================================