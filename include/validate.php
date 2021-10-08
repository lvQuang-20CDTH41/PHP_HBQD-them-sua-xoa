<?php
$name = $password = $email = '';
$nameErr = $passwordErr = $emailErr = '';
function xuly($data)
{
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
}
function validateEmail($email)
{
    $e = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    return preg_match($e, $email);
}
function validatePassword($pwd)
{
    $upperCase = preg_match('@[A-Z]@', $pwd);
    $lowerCase = preg_match('@[a-z]@', $pwd);
    $number = preg_match('@[0-9]@', $pwd);
    $specialChar = preg_match('@[^\w]@', $pwd);
    return (strlen($pwd) < 8  || !$upperCase || !$lowerCase || !$number  || !$specialChar) ? true : false;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $nameErr = "Tên tài khoản không được để trống";
    } else {
        $name = xuly($_POST['name']);
        if (!preg_match('/^[a-zA-Z]*$/', $name)) {
            $nameErr = "Chỉ chứa ký tự";
        }
    }
    if (empty($_POST['password'])) {
        $passwordErr = "Mật khẩu không được để trống";
    } else {
        $password = $_POST['password'];
        if (validatePassword($password)) {
            $passwordErr = "Password dài ít nhất 8 kí tự, trong 
                đó có ít nhất 1 kí tự hoa, 1 chữ số, 1 kí tự đặc biệt";
        }
    }
    if (empty($_POST['email'])) {
        $emailErr = 'Email không được để trống';
    } else {
        $email = xuly($_POST['email']);
        if (!validateEmail($email)) {
            $emailErr = "Email không đúng định dạng";
        }
    }
}
