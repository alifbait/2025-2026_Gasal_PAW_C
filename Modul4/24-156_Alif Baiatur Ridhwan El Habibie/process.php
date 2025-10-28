<?php
$errors = array();
$success = false;
$nama = "";
$email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($nama)) {
        $errors['nama'] = "Nama tidak boleh kosong!";
    }
    
    if (empty($email)) {
        $errors['email'] = "Email tidak boleh kosong!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid!";
    }
    
    if (empty($password)) {
        $errors['password'] = "Password tidak boleh kosong!";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password minimal 8 karakter!";
    }
    
    if (empty($errors)) {
        $success = true;
        $nama = "";
        $email = "";
    }
}
?>