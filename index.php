<?php
require "./include/validate.php";
if (isset($_POST['login'])) {
    header('location: login.php');
}
if (isset($_POST['display'])) {
    header('location: display.php');
}
if (isset($_POST['create'])) {
    if ($nameErr == '' && $passwordErr == '' && $emailErr == '') {
        $conn = new mysqli('localhost', 'root', '', 'testing1');
        if ($conn->connect_error) {
            echo $conn->connect_error;
        }
        $sql = 'insert into customer(customer_username,customer_password,customer_email) values("' . $name . '", "' . $password . '","' . $email . '")';
        $query = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card bg-info text-white">
            <div class="card-header">
                <h2 class="text-center">Tạo tài khoản</h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row mt-3">
                        <label for="name" class="col-from-label col-sm-2">Username: </label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="name" class="form-control" value="<?= $name ?>" placeholder="Nhập tên tài khoản">
                        </div>
                        <span class="text-danger col-sm-4">* <?php echo $nameErr; ?></span>
                    </div>
                    <div class="row mt-3">
                        <label for="password" class="col-from-label col-sm-2">Password: </label>
                        <div class="col-sm-6">
                            <input type="password" name="password" id="password" value="<?= $password ?>" class="form-control" placeholder="Nhập password">
                        </div>
                        <span class="text-danger col-sm-4">* <?php echo $passwordErr; ?></span>
                    </div>
                    <div class="row mt-3">
                        <label for="email" class="col-from-label col-sm-2">Email: </label>
                        <div class="col-sm-6">
                            <input type="text" name="email" id="email" class="form-control" value="<?= $email ?>" placeholder="Nhập Email">
                        </div>
                        <span class="text-danger col-sm-4">* <?php echo $emailErr; ?></span>
                    </div>
                    <div class="text-center mt-3 w-75">
                        <button type="submit" class="btn btn-success" name="create">Đăng Ký</button>
                        <button type="submit" class="btn btn-success" name="login">Đăng Nhập</button>
                        <button type="submit" class="btn btn-success" name="display">Hiển thị</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>