<?php
require './include/validate.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['password'])) {
        $user = $_POST['name'];
        $pwd = $_POST['password'];
        if ($nameErr == '' && $passwordErr == '') {
            $conn = new mysqli('localhost', 'root', '', 'testing1');
            $sql = 'select * from customer where customer_username = "' . $user . '"';
            $result = mysqli_query($conn, $sql)->fetch_assoc();
            if ($result['customer_password'] == $pwd) {
                header('location: display.php');
                die();
            } else {
                echo '<script>alert("Đăng nhập thất bại")</script>';
            }
            $conn->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card bg-info text-white">
            <div class="card-header">
                <h2 class="text-center">Đăng nhập</h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row mt-3">
                        <label for="name" class="col-sm-2 col-form-label">Username: </label>
                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" value="<?= $name ?>" class="form-control">
                        </div>
                        <span class="text-danger">* <?php echo $nameErr ?></span>
                    </div>
                    <div class="row mt-3">
                        <label for="pwd" class="col-sm-2 col-form-label">Password: </label>
                        <div class="col-sm-8">
                            <input type="password" name="password" id="pwd" value="<?= $password ?>" class="form-control">
                        </div>
                        <span class="text-danger">* <?php echo $passwordErr ?></span>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>