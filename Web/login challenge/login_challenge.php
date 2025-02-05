<?php
session_start(); // Start session to manage login status

// Database simulation (in a real app, you'd use a proper database)
$users = [
    'admin' => bin2hex(random_bytes(20)), // Random admin password
    'guest' => 'password'
];

// Handle login process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if credentials are correct
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['logged_in'] = true; // Set session variable to mark user as logged in
        $_SESSION['username'] = $username; // Store the username in session
        $flag = file_get_contents('/var/www/html/flag_for_login_challenge.txt');
        header('Flag: ' . $flag); // Send the flag header
        header('Location: login_challenge.php'); // Redirect to reload the page and show logged-in state
        exit;
    } else {
        echo 'Invalid credentials.';
    }
}

// Handle logout process
if (isset($_GET['logout'])) {
    session_unset(); // Unset session variables
    session_destroy(); // Destroy the session
    header('Location: login_challenge.php'); // Redirect to the login page after logout
    exit;
}

// Handle displaying source code
if (isset($_GET['source']) && $_GET['source'] == 1) {
    echo file_get_contents(__FILE__);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Challenge</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: black;
            color: lightgreen;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            padding: 20px;
            border: 2px solid lightgreen;
            border-radius: 10px;
            background-color: #222;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 0 15px lightgreen;
        }

        h1 {
            margin-bottom: 20px;
            font-weight: 500;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid lightgreen;
            border-radius: 5px;
            background-color: black;
            color: lightgreen;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }

        button {
            padding: 10px;
            border: 1px solid lightgreen;
            border-radius: 5px;
            background-color: lightgreen;
            color: black;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Roboto', sans-serif;
        }

        button:hover {
            background-color: #32cd32;
        }

        #sourceCode {
            display: none;
            margin-top: 20px;
            text-align: left;
            background-color: black;
            border: 1px solid lightgreen;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
            max-height: 200px;
            white-space: pre-wrap;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        #sourceCode.show {
            display: block;
            opacity: 1;
        }

        .logout-btn {
            margin-top: 20px;
            background-color: red;
        }
    </style>
    <script>
    function toggleSourceCode() {
      const sourceCode = document.getElementById('sourceCode');
      const button = document.getElementById('toggleButton');
      
      if (!sourceCode.classList.contains('show')) {
        sourceCode.classList.add('show');
        fetch('?source=1')
          .then(response => response.text())
          .then(data => {
            sourceCode.textContent = data;
          });
        button.textContent = 'Hide Source Code';
      } else {
        sourceCode.classList.remove('show');
        button.textContent = 'Show Source Code';
      }
    }
  </script>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <a href="?logout=true">
                <button class="logout-btn">Logout</button>
            </a>
            <button onclick="toggleSourceCode()">Show Source Code</button>
            <pre id="sourceCode"></pre>
        <?php else: ?>
            <h1>Login Challenge</h1>
            <form method="post" action="">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>
                <button type="submit">Login</button>
            </form>
            <!-- Button to toggle the source code view -->
            <button id="toggleButton" onclick="toggleSourceCode()">Show Source Code</button>

            <!-- Preformatted text to display the source code -->
            <pre id="sourceCode"></pre>
        <?php endif; ?>
    </div>
</body>
</html>
