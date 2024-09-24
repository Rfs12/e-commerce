<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $_POST['name'];
    $model_number = $_POST['model_number'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $images = $_FILES['img'];

    // Fetch the category name based on the category id
    $query = "SELECT category_name FROM categories WHERE id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $category_name = $row['category_name'];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Category not found.']);
        exit;
    }
    $stmt->close();

    // Ensure the 'uploads' directory exists
    if (!is_dir('uploads')) {
        if (!mkdir('uploads', 0777, true)) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create uploads directory.']);
            exit;
        }
    }

    // Handling multiple image uploads
    $imagePaths = [];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        if ($images['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = basename($images['name'][$key]);
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowable file types
            $maxFileSize = 5 * 1024 * 1024; // 5 MB max file size
            
            if (in_array($fileType, $allowedTypes) && $images['size'][$key] <= $maxFileSize) {
                $targetFilePath = "uploads/" . $fileName;

                // Move the uploaded file to the server
                if (move_uploaded_file($tmp_name, $targetFilePath)) {
                    $imagePaths[] = $targetFilePath;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file: ' . $fileName]);
                    exit;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid file type or size for: ' . $fileName]);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error uploading file: ' . $images['error'][$key]]);
            exit;
        }
    }

    // Convert the array of image paths to a JSON string
    $img = json_encode($imagePaths);

    // Insert product data into the database
    $query = "INSERT INTO products (name, model_number, price, quantity, img, description, category_id, name_of_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("ssdissis", $name, $model_number, $price, $quantity, $img, $description, $category_id, $category_name);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Product added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
