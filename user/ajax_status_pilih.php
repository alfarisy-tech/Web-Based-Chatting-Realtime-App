<?php
include("../koneksi.php");

session_start();
date_default_timezone_set('Asia/Jakarta');
$user = $_SESSION['user_id'];

$status = $_POST['status'];

// update nama dan email
mysqli_query($koneksi, "update user set user_status='$status' where user_id='$user'");