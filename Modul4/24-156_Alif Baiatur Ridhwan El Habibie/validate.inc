<?php
    function validateName(&$errors, $field_list, $field_name) {
        $pattern = "/^[a-zA-Z ]+$/";
        $nama = trim($field_list[$field_name]);
        if (empty($nama)) {
            $errors[$field_name] = 'tidak boleh kosong';
        } else if (!preg_match($pattern, $nama)) {
            $errors[$field_name] = 'input an salah';
        }
    }
    function validateEmail(&$errors, $field_list, $field_name) {
        $email = trim($field_list[$field_name]);
        if (empty($email)) {
            $errors[$field_name] = 'tidak boleh kosong';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[$field_name] = 'format yang anda inputkan salah';
        }
    }
?>