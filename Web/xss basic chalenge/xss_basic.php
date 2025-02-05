<!DOCTYPE html>
<html>
<head>
    <title>XSS Challenge Portal</title>
    <style>
        :root {
            --bg: #000;
            --accent: #90EE90;
        }
        body {
            background: var(--bg);
            color: var(--accent);
            font-family: monospace;
            margin: 20px;
        }
        .container {
            border: 2px solid var(--accent);
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        button, input, textarea {
            background: var(--bg);
            color: var(--accent);
            border: 1px solid var(--accent);
            padding: 8px;
            margin: 5px;
        }
        button:hover {
            background: var(--accent);
            color: var(--bg);
            cursor: pointer;
        }
        .hidden { display: none; }
        #adminView {
            border: 1px solid var(--accent);
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Login Screen -->
        <div id="login">
            <h1>🔒 RESTRICTED PORTAL</h1>
            <form onsubmit="return login(event)">
                <input type="text" id="username" placeholder="Username" required>
                <input type="password" id="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>

        <!-- User Interface -->
        <div id="userInterface" class="hidden">
            <button onclick="toggleView()">Switch to Admin View</button>
            
            <!-- Message Submission -->
            <div id="messageSection">
                <h2>📨 Contact Admin</h2>
                <form onsubmit="return sendMessage(event)">
                    <textarea id="message" placeholder="Your message..." required></textarea>
                    <button type="submit">Send Message</button>
                </form>
                <div id="verification" class="hidden">
                    <button onclick="checkExploit()">Verify Attack Success</button>
                    <p id="result"></p>
                </div>
            </div>

            <!-- Admin Simulation -->
            <div id="adminSection" class="hidden">
                <h2>🛡️ Admin Dashboard</h2>
                <button onclick="loadMessages()">Check Messages</button>
                <div id="adminView"></div>
            </div>
        </div>
    </div>

    <script>
        let xssDetected = false;
        let messages = [];
        const originalAlert = window.alert;

        // Authentication
        function login(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            if (username === 'user' && password === '1') {
                document.getElementById('login').classList.add('hidden');
                document.getElementById('userInterface').classList.remove('hidden');
                //loadStoredMessages();
            }
        }

        // Message handling
        function sendMessage(e) {
            e.preventDefault();
            const message = document.getElementById('message').value;
            messages.push(message);
            localStorage.setItem('messages', messages.join('|||'));
            document.getElementById('verification').classList.remove('hidden');
            e.target.reset();
        }

        function loadStoredMessages() {
            const stored = localStorage.getItem('messages');
            if (stored) {
                messages = stored.split('|||');
            }
        }

        // Admin simulation
        function loadMessages() {
            const adminView = document.getElementById('adminView');
            adminView.innerHTML = '';
            xssDetected = false;

            // Override alert for detection
            window.alert = function(message) {
                xssDetected = true;
                originalAlert(message);
            };

            // Use eval to execute scripts
            messages.forEach(msg => {
                const scriptTag = msg.match(/<script>(.*?)<\/script>/i);
                if (scriptTag) {
                    try {
                        eval(scriptTag[1]); // Execute script content
                    } catch (e) {
                        console.error("Script execution failed:", e);
                    }
                } else {
                    const div = document.createElement('div');
                    div.innerHTML = msg; // Render non-script content
                    adminView.appendChild(div);
                }
            });

            // Restore original alert after a delay
            setTimeout(() => {
                window.alert = originalAlert;
            }, 1000);
        }

        // View toggling
        function toggleView() {
            document.getElementById('messageSection').classList.toggle('hidden');
            document.getElementById('adminSection').classList.toggle('hidden');
            document.getElementById('adminView').innerHTML = '';
        }

        // Verification
        function checkExploit() {
            fetch('get_flag.php') // Fetch the flag from PHP
                .then(response => response.text())
                .then(flag => {
                    document.getElementById('result').innerHTML = xssDetected 
                        ? `✅ XSS Detected! ${flag}`
                        : '❌ No XSS detected';
                    xssDetected = false;
                })
                .catch(error => {
                    console.error('Error fetching flag:', error);
                    document.getElementById('result').innerHTML = '❌ Error retrieving flag';
                });
            
        }
    </script>
</body>
</html>