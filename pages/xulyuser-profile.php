<?php
include('../includes/config.php');
session_start();
if (isset($_GET['user-id'])) {
    $user_id = $_GET['user-id'];
}

if (isset($_POST['update-profile'])) {
    if (isset($_POST['name-user']) && isset($_POST['email-user']) && isset($_POST['phone-user'])) {
        // Sanitize user inputs
        $_SESSION['dangnhap'] = $_POST['name-user'];

        $name = mysqli_real_escape_string($conn, $_POST['name-user']);
        $email = mysqli_real_escape_string($conn, $_POST['email-user']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone-user']);

        // Prepare the SQL query
        $sql = "UPDATE loginuser SET HoTen = '$name', DienThoai = '$phone' WHERE email = '$user_id'";


        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>
            window.location.href = '../index.php?action=account&view=account';
            alert('Cập nhật thành công');
            </script>";
        } else {
            echo "Cập nhật không thành công";
        }
    }
}


if (isset($_POST['change-pass'])) {
    if (isset($_GET['user-id'])) {
        $user_id = $_GET['user-id'];
    }
    $old_pass = $_POST['old-pass'];
    $new_pass = $_POST['new-pass'];
    $check_pass = $_POST['check-pass'];
    $sql = "SELECT * FROM loginuser where email ='$user_id' ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $matkhau = $row['matkhau'];

    $thongbao = '';
    if ($old_pass != $matkhau) {
        $thongbao = 'Nhập sai mật khâu cũ';
        echo "<script>
        window.location.href = '../index.php?action=account&view=matkhau';
        alert('$thongbao');
        </script>";
    } else {
        if (strlen($new_pass) < 6) {
            $thongbao = 'Tối thiểu phải 6 ký tự';
            echo "<script>
            window.location.href = '../index.php?action=account&view=matkhau';
            alert('$thongbao');
            </script>";
        } elseif ($check_pass != $new_pass) {
            $thongbao = 'Nhập sai mật khẩu hiện tai';
            echo "<script>
            window.location.href = '../index.php?action=account&view=matkhau';
            alert('$thongbao');
            </script>";
        } else {
            $sql_update = "UPDATE loginuser SET matkhau = '$check_pass' WHERE email = '$user_id'";
            mysqli_query($conn, $sql_update);
            $thongbao = 'Đổi mật khẩu thành công';
            echo "<script>
            window.location.href = '../index.php?action=account&view=matkhau';
            alert('$thongbao');
            </script>";
        }
    }
}
