<?php
session_start();
include('../includes/config.php');

if (isset($_POST['addComment']) && !empty($_POST['comment'])) {
     $user_email = mysqli_real_escape_string($conn, $_SESSION['dangnhap']);
     $comment = mysqli_real_escape_string($conn, $_POST['comment']);
     $id = mysqli_real_escape_string($conn, $_POST['id']);
     $sql = "INSERT INTO comments (user_email, comment_text, product_id)
             VALUES ('$user_email', '$comment', '$id')";

     if (mysqli_query($conn, $sql)) {
          mysqli_close($conn);
          header("Location: {$_SERVER['HTTP_REFERER']}");
          exit;
     } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
} else {
     echo "Comment cannot be empty!";
}
