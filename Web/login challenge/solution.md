# Solution: Login Response Flag

## Challenge Description
This challenge presents a simple login form where users can log in with predefined credentials. However, after successful login, the flag is sent in the response headers.

## Steps to Solve

1. **Visit the Login Page**  
   Open `http://localhost:8000` in your browser.

2. **Login with Any User**  
   The challenge provides two users:  
   - **Username:** `guest`  
   - **Password:** `password`  

   You can log in with these credentials.

3. **Inspect the Response Headers**  
   - Open **Developer Tools** (F12 in most browsers).  
   - Go to the **Network** tab.  
   - Log in and select the request to `login_challenge.php`.  
   - Check the **Response Headers**, and you'll find a `Flag:` header containing the flag.

## Expected Flag Format
   {NmvkhxMk0wkVzGkZmyh03rhpODTg7I}


## Alternative Method: Using cURL
You can also retrieve the flag using a simple cURL command:
```sh
curl -i -X POST -d "username=guest&password=password" http://localhost:8000/login_challenge.php
```
The response headers will include the flag.
The response headers will include the flag.

## Summary
This challenge demonstrates how sensitive data can unintentionally be exposed in HTTP headers. Always verify what information is being sent in responses to avoid leaks. 