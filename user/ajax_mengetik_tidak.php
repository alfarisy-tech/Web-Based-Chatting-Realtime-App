<?php
include("../koneksi.php");

session_start();
date_default_timezone_set('Asia/Jakarta');
$user = $_SESSION['user_id'];

mysqli_query($koneksi,"DELETE FROM online WHERE online_pengirim='$user'");