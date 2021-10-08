<?php
function getData($s)
{
    $conn = new mysqli("localhost", "root", "", "testing1");
    $query = $conn->query($s);
    $xau = '';
    while ($r  = $query->fetch_array()) {
        $xau .=  $r['category_name'] . '<br>';
        $sql = $conn->query("select * from product where category_id = '" . $r['category_id'] . "'");
        while ($r1 = $sql->fetch_array()) {
            $xau .= '--' . $r1['product_name'] . ' <img src="./images/' . $r1['product_image'] . '" alt="" width="20px" height="20px"><br>
        ';
        }
    }
    return $xau;
}
// tìm kiếm
function search()
{
    if (isset($_POST['search'])) {
        $s = $_POST['search'];
        $conn = new mysqli("localhost", "root", "", "testing1");
        $query = $conn->query('select * from customer where customer_username = ' . $s);
        while ($r = $query->fetch_array()) {
            echo "<tr><td>" . $r['customer_username'] . "</td>";
            echo  "<td>" . $r['customer_password'] . '</td></tr>';
        }
    }
}
