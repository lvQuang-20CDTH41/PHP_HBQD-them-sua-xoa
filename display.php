<?php
require './include/database.php';
$s = '';
if (isset($_POST['search'])) {
    $s = $_POST['search'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card bg-info text-white">
            <div class="card-header">
                <h2 class="text-center">Danh sách tài khoản</h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="search" name="search" id="" value='<?= $s ?>' class="form-control" placeholder="Nhập tên tài khoản muốn tìm">
                    <table class="table table-bodered table-hover">
                        <thead>
                            <tr>
                                <th>Tên tài khoản</th>
                                <th>Mật khẩu</th>
                                <th>Sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = new mysqli("localhost", "root", "", "testing1");
                            if (isset($_POST['search'])) {
                                $sql = 'select * from customer where customer_username = "' . $s . '"';
                            } else {
                                $sql = 'select * from customer';
                            }
                            $query = $conn->query($sql);
                            while ($r = $query->fetch_array()) {
                                echo "<tr><td>" . $r['customer_username'] . "</td>";
                                echo  "<td>" . $r['customer_password'] . '</td>';
                                if (isset($_POST['search'])) {
                                    echo '<td><button type="submit" class="btn btn-warning" name="edit">Sửa</button></td>';
                                    echo '<td><button type="submit" class="btn btn-danger" name="delete">Xoá</button></td>';
                                } else {
                                    echo '<td></td>';
                                }

                                echo '<td><input type="text" name="id" class="d-none" value="' . $r['customer_id'] . '"></td></tr>';
                            }
                            // if (isset($_POST['edit'])) {
                            //     header('location: edit.php');
                            //     die();
                            // }

                            // mysqli_close($conn);
                            // if (isset($_POST['edit'])) {
                            //     header('location: edit.php');
                            //     die();
                            // }
                            if (isset($_POST['delete'])) {
                                $id = $_POST['id'];
                                $sql = 'delete from customer where customer_id = "' . $id . '"';
                                $query = $conn->query($sql);
                            }
                            if (isset($_POST['edit'])) {
                                $id = $_POST['id'];
                                $sql = 'select * from customer where customer_id = "' . $id . '"';
                                $query = $conn->query($sql);
                                while ($r = $query->fetch_array()) {
                                    echo '<input type="text" name="username" id="" class="mt-3 form-control" value="' . $r['customer_username'] . '">';
                                    echo '<input type="password" name="password" id="" class="mt-3 form-control" value="' . $r['customer_password'] . '">';
                                    echo '<td><input type="text" name="id" class="" value="' . $r['customer_id'] . '"></td></tr>';
                                    echo ' <button type="submit" class="btn btn-success mt-3" name="update">Sửa</button>';
                                }
                            }
                            if (isset($_POST['update'])) {
                                if (isset($_POST['id'])) {
                                    $sql = 'update customer set customer_username = "' . $_POST['username'] . '", customer_password = "' . $_POST['password'] . '" where customer_id = "' . $_POST['id'] . '"';
                                    $query = $conn->query($sql);
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success" name="">Xem</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>