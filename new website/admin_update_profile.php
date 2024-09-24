<?php
include('connect.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: signin.php');
    exit;
}

$user_id = $_SESSION['admin']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);



    // Update query
    if (!empty($password)) {
        // Update with password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($profile_img) {
            $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssi', $username, $email, $hashed_password, $user_id);
        } else {
            $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssi', $username, $email, $hashed_password, $user_id);
        }
    } else {
        // Update without password
        if ($profile_img) {
            $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssi', $username, $email, $user_id);
        } else {
            $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssi', $username, $email, $user_id);
        }
    }

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully";
    } else {
        $_SESSION['error_message'] = "Error updating profile";
    }

    $stmt->close();
    $conn->close();
    header('Location: admin_profile.php');
    exit;
}
