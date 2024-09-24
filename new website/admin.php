<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup/Signin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="button.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<div class=" justify-content-center">
<img src="logo.png" height="100vw"width="180vw"  />
</div>
<h1 class="text-center mb-4" style="color:#DB4646;">Admin Login</h1>
<div class="row justify-content-center">
    <div class="col-md-6">
        <ul class="nav nav-tabs" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" style="color:red;" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
            </li>
        </ul>
        <div class="tab-content" id="authTabsContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <div class="card">
                    <div class="card-header">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form id="signinForm" method="POST">
                            <div class="mb-3">
                                <label for="loginUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="loginUsername" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="loginPassword" name="password" required>
                            </div>
                            <button type="submit" name="login" class="button w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    
    $('#signinForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'admin_auth.php?action=signin',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire(response.message).then(() => {
                    if (response.status === 'success') {
                        window.location.href = 'admin_dashborad.php'; // Redirect to admin dashboard
                    } else {
                        setTimeout(() => {
                            window.location.href = 'admin.php'; // Redirect to admin login page
                        }, 2000); 
                    }
                });
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
