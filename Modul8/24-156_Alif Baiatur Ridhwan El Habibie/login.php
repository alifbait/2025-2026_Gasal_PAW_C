<?php
session_start();
require "koneksi.php"; 

if (isset($_POST['loginbtn'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']); // Hapus MD5 karena DB plain text

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query(DB, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error(DB));
    }

    $countdata = mysqli_num_rows($result);

    if ($countdata > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // Set session
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = $data['level'];

        header('Location: home.php');
        exit();
    } else {
        $error_message = "Username atau Password salah.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        .main { height: 100vh; }
        .login-box { width: 400px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-4 shadow">
            <h3 class="text-center mb-4">Login</h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button class="btn btn-primary w-100" type="submit" name="loginbtn">Login</button>
            </form>
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger mt-3'>$error_message</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
