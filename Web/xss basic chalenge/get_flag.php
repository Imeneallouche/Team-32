<?php
// Check if the request is a fetch request
if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
    // If not a fetch request, deny access
    http_response_code(403); // Forbidden
    echo "Forbidden";
    exit;
}

// Read the flag from the file
$flag = file_get_contents('flag_for_xss_basic.txt');

// Output the flag
echo $flag;
?>
