<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(["error" => "Unauthorized access. Maybe you're not the right type of visitor?"]);
    exit();
}

if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], "CTF-Scanner") !== false) {
    echo json_encode(["flag" => "shellmateCTF{H1dd3n_AP1_F0und}"]);
} else {
    echo json_encode(["error" => "Invalid request."]);
}
?>
