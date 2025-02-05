<?php
// Check if the source code should be shown
if (isset($_GET['source']) && $_GET['source'] == '1') {
    // Return the source code of this file
    echo file_get_contents(__FILE__);
    exit;
}
?>
<?php
// Database simulation (in a real app, you'd use a proper database)
$users = [
    'admin' => bin2hex(random_bytes(8)), // Random admin password
    'guest' => 'password'
];

// Handle POST request (login)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate credentials
    if (isset($users[$username]) && $users[$username] === $password) {
        // Set session cookie
        setcookie('session_user', $username);
        header('Location: cookie.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// Handle logout
if (isset($_POST['logout'])) {
    setcookie('session_user', '', time() - 3600); // Expire the cookie
    header('Location: cookie.php');
    exit;
}

// Get current user from cookie
$current_user = $_COOKIE['session_user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Service</title>
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
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 15px lightgreen;
    }

    h1, p {
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input[type="text"], input[type="submit"], button {
      padding: 10px;
      border: 1px solid lightgreen;
      border-radius: 5px;
      background-color: black;
      color: lightgreen;
      font-size: 16px;
    }

    input[type="submit"], button {
      background-color: lightgreen;
      color: black;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover, button:hover {
      background-color: #32cd32;
    }

    .error {
      color: red;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .flag {
      color: lightgreen;
      font-weight: bold;
      background-color: black;
      padding: 10px;
      border: 1px solid lightgreen;
      border-radius: 5px;
    }

    #sourceCode {
      display: none;
      text-align: left;
      background-color: black;
      border: 1px solid lightgreen;
      padding: 10px;
      border-radius: 5px;
      overflow-x: auto;
      max-height: 300px;
      white-space: pre-wrap;
      margin-top: 20px;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    #sourceCode.show {
      display: block;
      opacity: 1;
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
    <?php if (!$current_user): ?>
        <h1>Welcome to the Login Service</h1>
        <p>Please log in as admin to get the flag.</p>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="password" placeholder="Password" required>
            <input type="submit" value="Log In">
        </form>
    <?php else: ?>
        <h1>Hello, <?php echo htmlspecialchars($current_user); ?>!</h1>
        <?php if ($current_user === 'admin'): ?>
            <p class="flag"> <?php echo htmlspecialchars(file_get_contents('/var/www/html/flag_for_cookie.txt')); ?></p>
        <?php endif; ?>
        <form method="post">
            <button type="submit" name="logout">Log Out</button>
        </form>
    <?php endif; ?>
    <!-- Button to toggle the source code view -->
    <button id="toggleButton" onclick="toggleSourceCode()">Show Source Code</button>

    <!-- Preformatted text to display the source code -->
    <pre id="sourceCode"></pre>
  </div>
</body>
</html>


