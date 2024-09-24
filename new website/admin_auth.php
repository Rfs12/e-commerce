<?php
include('connect.php'); // Ensure this file properly connects to your database
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'];

    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Process signin
    if ($action === 'signin') {
        // Prepare the SQL statement directly
        $query = "SELECT * FROM users WHERE username = '$username' AND role = 'admin'";
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) { // No hashing, direct comparison
                $_SESSION['admin'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                echo json_encode(['status' => 'success', 'message' => 'Sign in successful']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Admin not found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }

    $conn->close();
}
