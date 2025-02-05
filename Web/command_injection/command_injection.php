<?php
// Check if the source code should be shown
if (isset($_GET['source']) && $_GET['source'] == '1') {
    // Return the source code of this file
    echo file_get_contents(__FILE__);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Directory Viewer</title>
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

    input[type="text"] {
      padding: 10px;
      border: 1px solid lightgreen;
      border-radius: 5px;
      background-color: black;
      color: lightgreen;
      font-size: 16px;
      font-family: 'Roboto', sans-serif;
    }

    input[type="submit"], button {
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

    input[type="submit"]:hover {
      background-color: #32cd32;
    }

    pre {
      text-align: left;
      background-color: black;
      border: 1px solid lightgreen;
      padding: 10px;
      border-radius: 5px;
      overflow-x: auto;
      max-height: 200px;
      white-space: pre-wrap;
      margin-top: 20px;
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
      max-height: 300px;
      white-space: pre-wrap;
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
    <h1>Directory Viewer</h1>
    <form method="GET">
      <label for="dir">Directory:</label>
      <input type="text" id="dir" name="dir" placeholder="Enter directory path" required />
      <input type="submit" value="Show Directory" />
    </form>
    <?php
      if (isset($_GET['dir'])) {
        // Sanitize input to prevent command injection
        $dir = str_replace(array('(', ')', ';', '`', '$', '<', '>', '&', '|'), '', $_GET['dir']); 
        
        

        // Execute the ls command and capture errors
        $output = shell_exec("ls $dir ");
        
        // Check if output is empty (indicating a possible error)
        if (empty($output)) {
          echo "<p>No output or an error occurred. Please check the directory path.</p>";
        } else {
         
            echo "<pre>" . htmlspecialchars($output) . "</pre>";
          
        }
      } else {
        echo "<p>Please provide a directory.</p>";
      }
    ?>
    <!-- Button to toggle the source code view -->
    <button id="toggleButton" onclick="toggleSourceCode()">Show Source Code</button>

    <!-- Preformatted text to display the source code -->
    <pre id="sourceCode"></pre>
  </div>
</body>
</html>
