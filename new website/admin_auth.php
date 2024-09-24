<?php
include('connect.php'); // Ensure this file properly connects to your database
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'];

    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';

    // Process signup or signin
    if ($action === 'signup') {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Sign up successful']);
        } else {
            // Check for specific SQL error codes to determine if the username/email is already taken
            if ($conn->errno === 1062) { // Duplicate entry error code
                echo json_encode(['status' => 'error', 'message' => 'This user is already registered.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'An error occurred during signup.']);
            }
        }
        $stmt->close();

    } elseif ($action === 'signin') {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
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
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
    
    $conn->close();
}
