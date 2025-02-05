# Solution: Cookie Header Exploit

## Description
This challenge involves exploiting a weak authentication mechanism that relies on cookies. Instead of logging in, the attacker can manually craft an HTTP request with a modified cookie header to gain access to the flag.

## Steps to Solve
1. Open your browser's developer tools or use a tool like `cURL` or `Burp Suite`.
2. Attempt to log in and observe the request and response headers.
3. Notice that authentication is based on the `session_user` cookie.
4. Modify the request to include the header:
   ```
   Cookie: session_user=admin
   ```
5. Send the modified request.
6. If successful, you should see the flag displayed on the page.

## Exploit using cURL
```bash
curl -X GET http://localhost:8000/cookie.php --cookie "session_user=admin"
```

## Exploit using Burp Suite
1. Intercept the login request.
2. Modify the `Cookie` header to `session_user=admin`.
3. Forward the request to the server.
4. The response should contain the flag.

## Flag
```
NLDAxBzI7yquLzc23NinN5yYUuNbd3
```

