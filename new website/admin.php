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
    <h1 class="text-center mb-4"style="color:#DB4646;">Admin Signup/Signin</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <ul class="nav nav-tabs" id="authTabs" role="tablist">
                <li class="nav-item"  role="presentation">
                    <button class="nav-link" style="color:red;" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab" aria-controls="signup" aria-selected="true">Signup</button>
                </li>
                <li class="nav-item"  role="presentation">
                    <button class="nav-link active" style="color:red;" id="signin-tab" data-bs-toggle="tab" data-bs-target="#signin" type="button" role="tab" aria-controls="signin" aria-selected="false">Signin</button>
                </li>
            </ul>
            <div class="tab-content" id="authTabsContent">
                <div class="tab-pane fade show active" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Signup</h2>
                        </div>
                        <div class="card-body">
                            <form id="signupForm" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="signup">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control"  name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="signupUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control"  name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="signupPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <button type="submit" class="button w-100">Signup</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                    <div class="card">
                        <div class="card-header">
                            <h2>Signin</h2>
                        </div>
                        <div class="card-body">
                            <form id="signinForm" method="POST">
                                <div class="mb-3">
                                    <label for="signinUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="signinUsername" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="signinPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="signinPassword" name="password" required>
                                </div>
                                <button type="submit" name="signin" class="button w-100">Sign In</button>
                            </form>
                        </div>
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
                Swal.fire(response.message);
                if (response.status === 'success') {
                    window.location.href = 'admin_dashborad.php'; // Redirect to admin dashboard
                }
            }
        });
    });

    $('#signupForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'admin_auth.php?action=signup',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire(response.message);
            }
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
