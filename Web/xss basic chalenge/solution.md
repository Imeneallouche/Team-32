# Solution for XSS Basic Challenge

## Step-by-step Guide

1. **Login Credentials**:
   - Inspect the page using your browser's developer tools (Right-click on the page → Inspect).
   - Navigate to the **Network** or **Application** tab and find the login credentials (username and password).
   - Example credentials found in the browser's developer tools:
     - Username: `user`
     - Password: `1`

2. **Login**:
   - Open the challenge page and login using the credentials found in step 1.

3. **Sending the XSS Payload**:
   - After logging in, send a message to the admin via the form.
   - In the message body, insert the following XSS payload:
     ```html
     <script>alert();</script>
     ```
   - This will trigger an alert in the admin's POV when they check the message.

4. **Admin POV**:
   - As the admin, go to the admin's POV page and press **Check Message**.
   - An alert should pop up on the admin's POV indicating that the XSS payload has executed successfully.

5. **Verify**:
   - Return to your user's POV and press the **Verify** button.
   - If you see the flag displayed, you have completed the challenge successfully!
   
   The flag will be: `{RdO2XEt7MwgtrhJSop3ByDo5VHPLsY}`.
