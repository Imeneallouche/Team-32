# Solution: Exploiting Command Injection in Directory Viewer

## Overview
The vulnerability in this challenge is a **command injection** vulnerability in the `ls` command execution. The input field for the directory path does not properly sanitize special characters, allowing an attacker to inject arbitrary shell commands.

## Exploit
The key to exploiting this vulnerability is the **URL encoding of a newline character (`%0A`)**, which allows chaining additional commands after the `ls` command.

### Steps to Exploit
1. Open the vulnerable application in your browser.
2. In the input field for the directory, enter the following payload:
   ```
   /var/www/html%0Acat /var/www/html/dir7/flag_for_command_injection.txt
   ```
3. Submit the form.
4. The response should now include the contents of the flag file:
   ```
   congrats you found the flag {cJsYtrH9E9iOzqd6Lte5JqSjKTcOy2}
   ```

### Explanation
- `%0A` is the URL-encoded representation of a **newline character**.
- When included in the input, the server interprets it as a command separator.
- This allows us to append `cat /var/www/html/dir7/flag_for_command_injection.txt`, which reads and displays the flag.

## Mitigation
To prevent this vulnerability:
- Use **escapeshellarg()** or **escapeshellcmd()** in PHP.
- Implement a whitelist for allowed directory names.
- Avoid using direct shell execution for user inputs.

By following these steps, the challenge can be solved, demonstrating a fundamental command injection exploit!
